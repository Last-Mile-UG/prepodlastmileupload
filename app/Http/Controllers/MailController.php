<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {

    private $subject, $body, $to;
    public function __construct($subject, $body, $to)
    {
      $this->subject = $subject;
      $this->body = $body;
      $this->to = $to;
    }
    public function basic_email() {
        Mail::send([], [], function ($message) {
            $message->to($this->to);
            $message->subject($this->subject);
            // $message->attach(asset('public/assets/img/brand/logo.png'));
            $message->setBody($this->body, 'text/html'); // for HTML rich messages
          });
    }

     public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\Users\CodeBox Solutions\Desktop\jira\tennis.jfif');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
     }

}