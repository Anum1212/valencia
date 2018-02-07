<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
Use App\Message;

class reply extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientData;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($recipientData)
  {
    $this->recipientData = $recipientData;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build(Request $req)
  {
      return $this->from('anamamer0@gmail.com', 'Laravel Practice Project')
      ->to($this->recipientData->senderEmail)
      ->subject('A test message for : ' . $this->recipientData->name)
      ->view('mails.reply',['reply'=>$req->messageReply]);
      // ->with(array('name'=>$this->recipientData->name, 'message'=>$req->messageReply));
      // $this->view('admin.messages.reply',['message'=>$req->messageReply])
  }
}
