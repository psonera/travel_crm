<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Trip;
use App\Models\User;
use App\Models\Product;
use App\Models\LeadType;
use App\Models\TripType;
use App\Models\Transport;
use App\Models\LeadSource;
use App\Models\LeadManager;
use App\Models\Accomodation;
use App\Models\LeadPipeline;
use Illuminate\Http\Request;
use App\Models\LeadPipelineStage;
use Illuminate\Contracts\View\View;
use App\Http\Requests\LeadFormRequest;

class LeadController extends Controller
{
    public function index(): View
    {
        if(request('view_type')){
            return view('leads.index.table',[
                'leads' => Lead::latest()->paginate(10),
            ]);
        }else{
            return view('leads.index.kanban',[
                'leads' => Lead::all(),
                'stages' => LeadPipelineStage::all()
            ]);
        }
    }

    public function create(): View
    {
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
        return view('leads.view',[
            'lead' => Lead::find($lead)
        ]);
    }

    public function store(LeadFormRequest $request)
    {
        $data = $request->validated();

        dd($data);

        $data['status'] = 1;
        $data['accomodation_id'] = $request->input('accomodation_id');

        if ($data['lead_pipeline_stage_id']) {
            $stage = LeadPipelineStage::findOrFail($data['lead_pipeline_stage_id']);

            $data['lead_pipeline_id'] = $stage->lead_pipeline_id;
        } else {
            $pipeline = LeadPipeline::findOneByField('is_default', 52)->first();

            $stage = $pipeline->leadStages->first();

            $data['lead_pipeline_id'] = $pipeline->id;

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

        // if($data['products']){
        //     foreach($data['products'] as $){

        //     }   
        // }

        session()->flash('success', 'Lead Created Successfully!!');

        return redirect()->route('leads.index');
    }

    public function edit(Lead $lead): View
    {
        return view('leads.edit',[
            'lead' => Lead::find($lead)
        ]);
    }

    public function update(Lead $lead, Request $request)
    {
        # code...
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return back()->with('success', 'Your Lead Deleted Successfully!');
    }

    public function add_product(Request $request)
    {
        $input = $request->only(['i']);

        if(!empty($input)){
            $html = view('forms.add_product', ['i' => $input['i']])->render();

            return response()->json([
                'html' => $html
            ]);
        }
    }

    public function find_lm(Request $request)
    {
        $request->validate([
            'search' => 'string',
            'user_id' => 'numeric',
            'type' => 'numeric'
        ]);
        $search = $request->search;
        $user_id = $request->user_id;
        $type = $request->type;
        $all_lead_managers = array();

        if($type == 1){
            $all_lead_managers = LeadManager::where('name', 'like', '%'.$search.'%')->get();

            return response()->json($all_lead_managers);
        }

        if($type == 2){
            $lead_manager = LeadManager::where('id', $user_id)->first();

            return response()->json($lead_manager);
        }
    }

    public function find_prd(Request $request)
    {
        $request->validate([
            'search_prd' => 'string',
            'prd_id' => 'numeric',
            'type' => 'numeric',
        ]);
        $search_prd = $request->search_prd;
        $prd_id = $request->prd_id;
        $type = $request->type;
        $all_prds = array();

        if($type == 1){
            $all_prds = Product::where('name', 'like', '%'.$search_prd.'%')
                                // ->whereNotIn('id', $selected)
                                ->get();

            return response()->json($all_prds);
        }

        if($type == 2){
            $product = Product::where('id', $prd_id)->first();

            return response()->json($product);
        }
    }

    public function find_trip(Request $request)
    {
        $request->validate([
            'search_trip' => 'string',
            'trip_id' => 'numeric',
            'type' => 'numeric'
        ]);
        $search_trip = $request->search_trip;
        $trip_id = $request->trip_id;
        $type = $request->type;
        $all_trips = array();

        if($type == 1){
            $all_trips = Trip::where('title', 'like', '%'.$search_trip.'%')->get();

            return response()->json($all_trips);
        }

        if($type == 2){
            $trip = Trip::where('id', $trip_id)->first();

            return response()->json($trip);
        }
    }

    public function change_status(Request $request)
    {
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
            $lead->save();
            $res['success'] = 'Lead status changed successfully to "'. $stage->name .'"!!';
        } else {
            $res['error'] = 'Lead status could not change successfully to "'. $stage->name .'"!!';
        }

        return response()->json($res);
    }
}
