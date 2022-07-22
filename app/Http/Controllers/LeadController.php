<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        return view('leads.index',[
            'leads' => Lead::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('leads.create');
    }

    public function show(Lead $lead)
    {   
        return view('leads.view',[
            'lead' => Lead::find($lead)
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Lead $lead)
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
