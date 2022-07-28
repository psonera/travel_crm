<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Requests\EmailTemplateFormRequest;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.email_templates.index',[
            'email_templates' => EmailTemplate::latest()->paginate(10)
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.email_templates.create');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EmailTemplateFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailTemplateFormRequest $request)
    {
        $validated = $request->validated();
      
        EmailTemplate::create($validated);

        return redirect()->route('settings.email_templates.index')->with('success','Email Template has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  EmailTemplate $email_template
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  EmailTemplate $email_template
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $email_template)
    {
        return view('settings.email_templates.edit', compact('email_template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EmailTemplateFormRequest  $request
     * @param  EmailTemplate $email_template
     * @return \Illuminate\Http\Response
     */
    public function update(EmailTemplateFormRequest $request,EmailTemplate $email_template)
    {
        $validated = $request->validated();
        
        if($email_template){
            $email_template->update($validated);
            $email_template->save();
        }
        return redirect()->route ('settings.email_templates.index')->with('success','Email Template Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  EmailTemplate $email_template
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $email_template)
    {
        $email_template->delete();
        return redirect()->route('settings.email_templates.index')->with('success','Email Template has been deleted successfully');
    }
}
