<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
Use App\Message;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        return $this->from('anamamer0@gmail.com', 'Laravel Practice Project')
        ->to($req->email)
        ->subject('A test message for : ' . $req->name)
        ->view('mails.testMail',['name'=>$req->name]);
        // ->with(array('name'=>$this->recipientData->name, 'message'=>$req->messageReply));
        // $this->view('admin.messages.reply',['message'=>$req->messageReply])
    }
}
