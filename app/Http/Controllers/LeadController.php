<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadPipelineStage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        return view('leads.create');
    }

    public function show(Lead $lead): View
    {   
        return view('leads.view',[
            'lead' => Lead::find($lead)
        ]);
    }

    public function store(Request $request)
    {
        //
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
}
