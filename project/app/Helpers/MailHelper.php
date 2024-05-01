<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail; // Assuming you have a Mailable class named SendMail
class MailHelper
{

 public static function sendMail($recipient, $subject, $data, $view){

        Mail::to($recipient)->send(new SendMail($data, $view,$subject));

 }
}