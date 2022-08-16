<?php

namespace App\Http\Controllers;

use App\Mail\Compose;
use App\Models\Email;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
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
    // Storing mail data in the database
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
    // Sending mail    
    $emailAddress = $request->to;
    $cc = $request->cc;
    $bcc = $request->bcc;
    $email = [
        'cc' => $cc,
        'bcc' => $bcc,
    ];
    
    $subject = $request->subject;
    
    $data = [
        "content" => $request->content,
        "attachment" => $request->attachment
    ];        
    Mail::to($emailAddress)
        ->cc($cc)
        ->bcc($bcc)
        ->send(new Compose($data,$email,$subject));

    $mail->save();

    return redirect()->route('mails.sent')->with('success','Email has been sent successfully.');
 }

 public function sendDraft($id)
 {
  // for sending emails from draft
     // Sending mail    
     $mail = Email::findOrFail($id);
     $status =  EMAIL::SENT; 
     $mail->status = $status;
     $mail->save();

     $emailAddress = $mail->to;
     $cc = $mail->cc;
     $bcc = $mail->bcc;
     $email = [
         'cc' => $cc,
         'bcc' => $bcc,
     ];
     
     $subject = $mail->subject;
     
     $data = [
         "content" => $mail->content,
         "attachment" => $mail->attachment
     ];        
     Mail::to($emailAddress)
         ->cc($cc)
         ->bcc($bcc)
         ->send(new Compose($data,$email,$subject)); 

     return view('mails.sent');
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

    return response()->json([
        'success' => true
    ]);
  }
  
  public function getDraft()
  {
      $mails = Email::where('status',Email::DRAFT)->get();
      return view('mails.draft',compact('mails'));  
  }
  
  public function sent()
  {
      $mails = Email::where('status',Email::SENT)->get();
      return view('mails.sent',compact('mails'));
  }

  public function destroy($id)
  {
      $mail = Email::findOrFail($id);
      $status = Email::TRASH;
      $mail->status = $status;
      $mail->save();

      $mail->delete();  
      return response()->json([
          'success' => true,
      ]);
  }

  public function trash()
  {
    //  $mails = Email::where('status',Email::TRASH);  
    
      $mails = Email::withTrashed()->get();
    //   dd($mails);
      return view('mails.trash',compact('mails'));
  }

  public function restore($id)
  {
      $mail = Email::withTrashed()->find($id);
      $mail -> restore();
      return view('mails.trash',compact('mail'));
  }

  public function forceDelete($id)
  {
      $mail = Email::withTrashed()->find($id);
      $mail -> forceDelete();

      return response()->json([
          'success' => true,
      ]);
    //   return view('mails.trash',compact('mail'));
  }

}