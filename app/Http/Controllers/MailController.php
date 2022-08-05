<?php

namespace App\Http\Controllers;

use App\Mail\Compose;
use App\Models\Email;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
 public function compose()
 {
    $templates = EmailTemplate::all();
    return view('mails.compose',compact('templates'));
 }

 public function index()
 {
   return view('mails.index');
 }
 
 public function store(Request $request)
 { 
    $status =  EMAIL::SENT;
      
    $mail = Email::Create([
      'to' => $request->to,
      'cc' => $request->cc,
      'bcc' => $request->bcc,
      'from' => Auth::user()->email,
      'subject' => $request->subject,
      'content' => $request->content,
      "status" => $status,    
    ]);
     
    if($request->attachment === true)  
    {      
      $mail ->addMedia($request->attachment)
            ->preservingOriginal()
            ->toMediaCollection('attachment');
    }
   
    $emailAddress = $request->to;
    $data = [
        "content" => $request->content,
        "subject" => $request->subject,
        "attachment" => $request->attachment
    ];        
    Mail::to($emailAddress)->send(new Compose($data));

    $mail->save();

    return redirect()->route('mails.sent')->with('success','Email has been sent successfully.');
 }

 public function draft(Request $request)
 {
      $status =  EMAIL::DRAFT; 

      $mail = Email::Create([
        'to' => $request->to,
        'cc' => $request->cc,
        'bcc' => $request->bcc,
        'from' => Auth::user()->email,
        'subject' => $request->subject,
        'content' => $request->content,
        "status" => $status,    
      ]);

      $mails = Email::where('status', 'draft');

      return response()->json([
        'success' => true
      ]);

    }
  
    public function getDraft()
    {
      $mails = Email::where('status','3')->get();
      return view('mails.draft',compact('mails'));  
    }
 
 public function sent()
 {
    $mails = Email::where('status','2')->get();
    return view('mails.sent',compact('mails'));
 }

 public function inbox()
 {
      $mails = Email::all();
      // $mails = Email::where('status', 'inbox');
      return view('mails.inbox',compact('mails'));
 }


 public function outbox()
 {
      $mails = Email::where('status', 'outbox');
      return view('mails.outbox',compact('mails'));
 }

 public function destroy(Email $mail)
 {
    $status = Email::TRASH;
    $mail->status =$status;
    $mail->save();
    $mail->delete();

   return view ('mails.inbox');
 }

 public function trash()
 {  
   $mails = Email::withTrashed()->get();
   return view('mails.trash',compact('mails'));
 }

}
