<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required', 
        ]);

        EmailTemplate::create($request->all());

        return redirect()->route('settings.email_templates.index')->with('success','Email Template has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $email_template)
    {
        return view('settings.email_templates.edit', compact('email_template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,EmailTemplate $email_template)
    {
        if($email_template)
        {
        $email_template->update([
            'name' => $request->name ? $request->name : $email_template->name,
            'subject' => $request->subject ? $request->subject : $email_template->subject,
            'content' => $request->content ? $request->content : $email_template->content,
        ]);
        
        $email_template ->save();
        }

        return redirect()->route ('settings.email_templates.index')->with('success','Email Template Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTemplate $email_template)
    {
        $email_template->delete();
    
        return redirect()->route('settings.email_templates.index')->with('success','Email Template has been deleted successfully');
    }
}
