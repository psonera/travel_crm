<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\MailFormRequest;
use PDO;
use Exception;

use App\Mail\Compose;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MailController extends Controller
{

    public function compose()
    {
        $this->authorize('compose.mails',Mail::class);
        return view('mails.compose');
    }

    public function index()
    {
        return view('mails.sent');
    }

    public function store(EmailRequest $request)
    {
        $this->authorize('compose.mails',Mail::class);
        $message = '';
        if($request->has('save')){

            $status =  EMAIL::SENT;
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
            //save Mail Detail
            $mail = Email::Create([
                'to' => $request->to,
                'cc' => $request->cc,
                'bcc' => $request->bcc,
                'from' => Auth::user()->email,
                'subject' => $request->subject,
                'content' => $request->content,
                "status" => $status,
                'user_id'=>auth()->user()->id
                ]);

                if($request->has('attachment'))
                {
                foreach($request->attachment as $file){
                        $mail ->addMedia($file)
                        ->toMediaCollection('attachment', 'attachment_file');
                    }
                }
            //Attach Mail Id
            $data['mail'] = $mail;
            //sending mail
            Mail::to($emailAddress)
                ->cc($cc)
                ->bcc($bcc)
                ->send(new Compose($data,$email,$subject));
            if(Mail::flushMacros()){
                //Send mail into draft
                $mail = Mail::find($mail->id)->delete();
                $message = "Something Went Wrong.";
                return redirect()->route('mails.draft')->with('success',$message);
            }else{
                $message = "Email has been sent successfully.";
            }

        }else if($request->has('save_as_draft')){
            
            $this->authorize('draft.mails',Mail::class);
            $status =  EMAIL::DRAFT;
            $mail = Email::Create([
                'to' => $request->to,
                
                'from' => Auth::user()->email,
                'subject' => $request->subject,
                'content' => $request->content,
                "status" => $status,
                'user_id'=>auth()->user()->id
                ]);

                if($request->has('attachment'))
                {
                foreach($request->attachment as $file){
                        $mail ->addMedia($file)
                        ->toMediaCollection('attachment', 'attachment_file');
                    }
                }
                $message = "Email has been store as draft successfully.";
                return redirect()->route('mails.draft')->with('success',$message);
        }

        return redirect()->route('mails.sent')->with('success',$message);
    }

    public function edit($id){
        $this->authorize('compose.mails',Mail::class);
        $mail = Email::find($id);
        return view('mails.editdraft',compact('mail'));
    }

    public function update(Request $request, $id){
        $this->authorize('update.mails',Mail::class);

        $mail = Email::find($id);    
        $message = '';
        if($request->has('save')){

            $status =  EMAIL::SENT;
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
            $data['mail'] = $mail;
            $mail->to = $request->to;
            $mail->cc = $request->cc;
            $mail->bcc = $request->bcc;
            $mail->from = Auth::user()->email;
            $mail->subject = $request->subject;
            $mail->content = $request->content;
            $mail->status = $status;
            $mail->save();
            if($request->has('attachment'))
            {

                //update files
            foreach($request->attachment as $file){
                    $mail ->addMedia($file)
                    ->toMediaCollection('attachment', 'attachment_file');
                }
            }

            Mail::to($emailAddress)
                ->cc($cc)
                ->bcc($bcc)
                ->send(new Compose($data,$email,$subject));

            if(Mail::flushMacros()){
                //don't save mail
                //Send mail into draft
                $mail = Mail::find($mail->id)->delete();
                $message = "Something Went Wrong.";
                return redirect()->route('mails.draft')->with('success',$message);
            }else{
                $message = "Email has been sent successfully.";
            }

        }else if($request->has('save_as_draft')){
                
                $status =  EMAIL::DRAFT;
                $mail->to = $request->to;
                $mail->cc = $request->cc;
                $mail->bcc = $request->bcc;
                $mail->from = Auth::user()->email;
                $mail->subject = $request->subject;
                $mail->content = $request->content;
                $mail->status = $status;
                $mail->save();
                if($request->has('attachment'))
                {
                    //update files
                foreach($request->attachment as $file){
                        $mail ->addMedia($file)
                        ->toMediaCollection('attachment', 'attachment_file');
                    }
                }
                $message = "Email has been Updated as draft successfully.";
                return redirect()->route('mails.draft')->with('success',$message);
        }
        dd('not');
        return redirect()->route('mails.sent')->with('success',$message);
    }

    public function sendDraft($id){
        $this->authorize('sent.mails',Mail::class);

        // for sending emails from draft
        // Sending mail
        $message = '';
        $mail = Email::findOrFail($id);
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
        $data['mail'] = $mail;

        Mail::to($emailAddress)->cc($cc)->bcc($bcc)->send(new Compose($data,$email,$subject));
        if(Mail::flushMacros()){
            $message = 'Somthing went Wrong ';
            return redirect(route('mails.draft'))->with('success',$message);
        }else{
            $message = "Mail Sent Successfully";
            $status =  EMAIL::SENT;
            $mail->status = $status;
            $mail->save();
        }
        return redirect(route('mails.sent'))->with('success',$message);
    }

    public function draftview(){
        $this->authorize('draft.mails',Mail::class);
        return view('mails.draft');
    }

    public function sent()
    {
        $this->authorize('sent.mails',Mail::class);
        return view('mails.sent');
    }


    public function destroy($id)
    {
        $this->authorize('delete.mails',Mail::class);
        $mail = Email::findOrFail($id);
        $mail->save();
        $mail->delete();
        return redirect()->route('mails.trash');
    }
    public function trash()
    {
        $this->authorize('trash.mails',Mail::class);
        return view('mails.trash');
    }
    public function restore($id)
    {
        $this->authorize('update.mails',Mail::class);
        $mail = Email::withTrashed()->find($id);
        if($mail->restore()){
            if($mail->status==1){
                return redirect(route('mails.sent'))->with('success','Mail Has Been Restore.');
            }
            if($mail->status==2){
                return redirect(route('mails.draft'))->with('success','Mail Has Been Restore.');
            }
        }
    }

    public function forceDelete($id)
    {
        $this->authorize('delete.mails',Mail::class);
        $mail = Email::withTrashed()->find($id);
        foreach($mail->getMedia('attachment') as $media){
            $media->delete();
        }
        $mail -> forceDelete();
        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteattachment($uuid){
        $media = Media::where('uuid',$uuid)->first();
        $media->delete();
        return response()->json(true);
    }
}
