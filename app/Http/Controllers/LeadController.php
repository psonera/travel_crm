<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Trip;
use App\Models\User;
use App\Events\NewLead;
use App\Models\Product;
use App\Models\LeadType;
use App\Models\TripType;
use App\Models\Transport;
use App\Events\AssignLead;
use App\Models\LeadSource;
use App\Models\LeadManager;
use App\Models\LeadProduct;
use App\Models\Accomodation;
use Illuminate\Http\Request;
use App\Models\LeadPipelineStage;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LeadFormRequest;

class LeadController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('leads',Lead::class);
        $request->validate([
            'view_type' => 'string'
        ]);
        if($request->view_type == 'table'){
            return view('leads.index.table',[
                'leads' => Lead::latest()->paginate(10),
            ]);
        } else if($request->view_type == ''){
            return view('leads.index.kanban',[
                'leads' => Lead::all(),
                'stages' => LeadPipelineStage::all()
            ]);
        } else {
            return view('errors.404');
        }
        
    }

    public function create(): View
    {
        $this->authorize('create.leads',Lead::class);
        return view('leads.create',[
            'leads' => Lead::all(),
            'sources' => LeadSource::all(),
            'types' => LeadType::all(),
            'lead_managers' => LeadManager::all(),
            'managers' => User::all(),
            'trip_types' => TripType::all(),
            'accomodations' => Accomodation::all(),
            'transports' => Transport::all()
        ]);
    }

    public function view(Lead $lead): View
    {   
        $this->authorize('view.leads',Lead::class);
        return view('leads.view',[
            'lead' => Lead::with(['leadProducts', 'activities', 'quotations'])->where('id', $lead->id)->first()
        ]);
    }

    public function store(LeadFormRequest $request)
    {
        $this->authorize('store.leads',Lead::class);
        $data = $request->validated();

        $data['status'] = 1;
        $data['accomodation_id'] = $request->input('accomodation_id');

        if ($data['lead_pipeline_stage_id']) {
            $stage = LeadPipelineStage::findOrFail($data['lead_pipeline_stage_id']);
        } else {
            $stage = LeadPipelineStage::where('code', '=', 'new')->get();

            $data['lead_pipeline_stage_id'] = $stage->id;
        }
        
        if($data['selected_trip_date']){
            $data['selected_trip_date'] = Carbon::parse($data['selected_trip_date']);
        }

        if($data['expected_closed_date']){
            $data['expected_closed_date'] = Carbon::parse($data['expected_closed_date']);
        }

        if (in_array($stage->code, ['won', 'lost'])) {
            $data['closed_at'] = Carbon::now();
        }

        $lead = Lead::create($data);

        if(isset($data['products'])){
            foreach($data['products'] as $product){
                $lead_product = array(
                    'name' => $product['name'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'amount' => $product['amount'],
                    'lead_id' => $lead->id,
                    'product_id' => $product['id']
                );
                LeadProduct::insert($lead_product);
                $update_product = Product::where('id', $product['id'])->first();
                $change_qty = $update_product->quantity - $product['quantity'];
                $update_product->quantity = $change_qty;
                $update_product->save();
            }
        }

        if($lead){
            NewLead::dispatch($lead);
        }

        session()->flash('success', 'Lead Created Successfully!!');

        return redirect()->route('leads.index');
    }

    public function edit(Lead $lead): View
    {
        $this->authorize('update.leads',Lead::class);
        return view('leads.edit',[
            'lead' => $lead,
            'sources' => LeadSource::all(),
            'types' => LeadType::all(),
            'lead_managers' => LeadManager::all(),
            'managers' => User::all(),
            'trip_types' => TripType::all(),
            'accomodations' => Accomodation::all(),
            'transports' => Transport::all(),
            'manager' => $lead->user->toArray()
        ]);
    }

    public function update(Lead $lead, LeadFormRequest $request)
    {
        $this->authorize('update.leads',Lead::class);
        $data = $request->validated();

        $data['accomodation_id'] = $request->input('accomodation_id');

        if ($data['lead_pipeline_stage_id']) {
            $stage = LeadPipelineStage::findOrFail($data['lead_pipeline_stage_id']);
        } else {
            $stage = LeadPipelineStage::where('code', '=', 'new')->get();

            $data['lead_pipeline_stage_id'] = $stage->id;
        }

        if($stage->code == 'lost'){
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        
        if($data['selected_trip_date']){
            $data['selected_trip_date'] = Carbon::parse($data['selected_trip_date']);
        }

        if($data['expected_closed_date']){
            $data['expected_closed_date'] = Carbon::parse($data['expected_closed_date']);
        }

        if (in_array($stage->code, ['won', 'lost'])) {
            $data['closed_at'] = Carbon::now();
        }

        $old_LM_id = $lead->lead_manager_id;
        $old_M_id = $lead->user_id;

        $lead->update($data);

        if($lead->lead_manager_id != $old_LM_id){
            AssignLead::dispatch($lead, true);
        }

        if($lead->user_id != $old_M_id){
            AssignLead::dispatch($lead, false);
        }

        if(isset($data['products'])){
            foreach($lead->leadProducts as $lead_prd){
                $lead_prd->delete();
            }
            foreach($data['products'] as $product){
                $lead_product = array(
                    'name' => $product['name'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'amount' => $product['amount'],
                    'lead_id' => $lead->id,
                    'product_id' => $product['id']
                );
                LeadProduct::insert($lead_product);
                $update_product = Product::where('id', $product['id'])->first();
                $change_qty = $update_product->quantity - $product['quantity'];
                $update_product->quantity = $change_qty;
                $update_product->save();
            }
        } else {
            foreach($lead->leadProducts as $lead_prd){
                $lead_prd->delete();
            }
        }

        session()->flash('success', 'Lead Updated Successfully!!');

        return redirect()->route('leads.index');
    }

    public function destroy(Lead $lead)
    {
        $this->authorize('delete.leads',Lead::class);
        $lead->delete();

        return back()->with('success', 'Your Lead Deleted Successfully!');
    }

    public function find_lm(Request $request)
    {
        $request->validate([
            'search' => 'string',
        ]);
        $search = $request->search;

        $all_lead_managers = LeadManager::where('name', 'like', '%'.$search.'%')->get();
        
        return response()->json($all_lead_managers);
    }

    public function find_manager(Request $request)
    {
        $request->validate([
            'search' => 'string',
            'participant' => 'numeric'
        ]);
        $search = $request->search;
        $participant = $request->participant;

        if($participant != ''){
            $res['users'] = User::where('name', 'like', '%'.$search.'%')->where('is_lead_manager', 0)->where('is_admin', 0)->where('is_manager', 0)->get();
            $res['lead_managers'] = User::where('name', 'like', '%'.$search.'%')->where('is_lead_manager', 1)->get();
            
            return response()->json($res);
        }

        $all_managers = User::where('name', 'like', '%'.$search.'%')->get();

        return response()->json($all_managers);
    }

    public function find_prd(Request $request)
    {
        $request->validate([
            'search' => 'string',
        ]);
        $search = $request->search;

        $all_prds = Product::where('name', 'like', '%'.$search.'%')->get();

        return response()->json($all_prds);
    }

    public function find_trip(Request $request)
    {
        $request->validate([
            'search' => 'string',
        ]);
        $search = $request->search;
        $all_trips = Trip::where('title', 'like', '%'.$search.'%')->get();
        return response()->json($all_trips);
    }

    public function change_status(Request $request)
    {
        $this->authorize('update.leads',Lead::class);
        $request->validate([
            'stage_id' => 'numeric',
            'lead_id' => 'numeric'
        ]);

        $res = array();
        $stage_id = $request->stage_id;
        $lead_id = $request->lead_id;

        $stage = LeadPipelineStage::findOrFail($stage_id);

        if($lead_id && $stage_id){
            $lead = Lead::findOrFail($lead_id);
            $lead->lead_pipeline_stage_id = $stage_id;
            if($stage->code == 'won' || $stage->code == 'lost'){
                $lead->closed_at = Carbon::now();
            }
            $lead->save();
            $res['success'] = 'Lead status changed successfully to "'. $stage->name .'"!!';
        } else {
            $res['error'] = 'Lead status could not change successfully to "'. $stage->name .'"!!';
        }

        return response()->json($res);
    }

    public function get(){
        $where = array();
        if(auth()->user()->hasRole('lead-manager')){
            $where['status'] = 1;
            $where['lead_manager_id'] = auth()->user()->id;
        } else if(auth()->user()->hasRole('manager')){
            $where['status'] = 1;
            $where['user_id'] = auth()->user()->id;
        } else {
            $where['status'] = 1;
        }
        return response()->json([
            'stages' => LeadPipelineStage::with(['leads' => function($query)  use ($where) { $query->with(['leadManager'])->where($where); } ])->orderBy('id', 'ASC')->get(['id', 'name'])->toArray(),
        ]);
    }

    public function remove_stage(Request $request){
        $this->authorize('update.leads',Lead::class);
        $request->validate([
            'stage_id' => 'numeric',
        ]);
        $response = array();
        $stage_id = $request->stage_id;
        $stage = LeadPipelineStage::where('id', $stage_id)->first();
        if($stage->code != 'new' || $stage->code != 'won' || $stage->code != 'lost'){
            $leads = Lead::where('lead_pipeline_stage_id', $stage_id)->get();

            if($stage && $leads){
                foreach($leads as $lead){
                    $lead->lead_pipeline_stage_id = 1;
                    $lead->save();
                }

                $stage->delete();
                $response['success'] = '"'. $stage->name .'" stage is deleted successfully, and all leads are moved to NEW!!';
            } else {
                $response['error'] = '"'. $stage->name .'" stage could not be deleted. Try again later';
            }
        } else {
            $response['error'] = '"'. $stage->name .'" stage can not be deleted. It is permanent!!';
        }
        return response()->json($response);
    }

    public function get_stages(){
        $stages = LeadPipelineStage::all();
        return response()->json($stages);
    }
}