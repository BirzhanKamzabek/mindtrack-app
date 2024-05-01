<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function send_reset_password_email(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->email;

        // Check User's Email Exists or Not
        $user = User::where('email', $email)->first();
        if(!$user){
            return response([
                'message'=>'Email doesnt exists',
                'status'=>'failed'
            ], 404);
        }

        // Generate Token
        $token = Str::random(60);

        // Saving Data to Password Reset Table
        PasswordReset::create([
            'email'=>$email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
        
        // Sending EMail with Password Reset View
        Mail::send('reset', ['token'=>$token], function(Message $message)use($email){
            $message->subject('Reset Your Password');
            $message->to($email);
        });
        return response([
            'message'=>'Password Reset Email Sent... Check Your Email',
            'status'=>'success'
        ], 200);
    }

    public function reset(Request $request, $token){
        // Delete Token older than 2 minute
        $formatted = Carbon::now()->subMinutes(20)->toDateTimeString();
        PasswordReset::where('created_at', '<=', $formatted)->delete();

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $passwordreset = PasswordReset::where('token', $token)->first();

        if(!$passwordreset){
            return response([
                'message'=>'Token is Invalid or Expired',
                'status'=>'failed'
            ], 404);
        }

        $user = User::where('email', $passwordreset->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token after resetting password
        PasswordReset::where('email', $user->email)->delete();

        return response([
            'message'=>'Password Reset Success',
            'status'=>'success'
        ], 200);
    }



/////  for laravel website jeevanheal 

public function send_forget_password_email(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $email = $request->email;

    // Check if User's Email Exists or Not
    $user = User::where('email', $email)->first();
    if (!$user) {
        return  redirect()->back()->with('error', 'Email Does Not Exists');
    }

    // Generate Token
    $token = Str::random(60);

    // Save Data to Password Reset Table
    PasswordReset::create([
        'email' => $email,
        'token' => $token,
        'created_at' => Carbon::now()
    ]);

    try {
        // Send Email with Password Reset View
        Mail::send('reset_password', ['token' => $token], function ($message) use ($email) {
            $message->subject('Reset Your Password');
            $message->to($email);
        });

        return redirect('/forgot-passwords')->with('success', 'You have successfully sent a link to your email. Please check your email!');
    } catch (\Exception $e) {
        // Handle exception (e.g., log it, show an error message)
        return redirect('/forgot-passwords')->with('error', 'Failed to send the password reset link. Please try again.');
    }
}


public function reset_password(Request $request){
    // Delete Token older than 2 minute
    $token=$request->token;
    $formatted = Carbon::now()->subMinutes(60)->toDateTimeString();
    PasswordReset::where('created_at', '<=', $formatted)->delete();

    $request->validate([
        'password' => 'required|confirmed',
    ]);

    $passwordreset = PasswordReset::where('token', $token)->first();

    if(!$passwordreset){
        return response([
            'message'=>'Token is Invalid or Expired',
            'status'=>'failed'
        ], 404);
    }

    $user = User::where('email', $passwordreset->email)->first();
    $user->password = Hash::make($request->password);
    $user->save();

    // Delete the token after resetting password
    PasswordReset::where('email', $user->email)->delete();

    return redirect()->back()->with('success', 'You have successfully Changed Your Password!');

}


public function forgot_change_password($token){

    return view('/forgot-change-password',compact('token'));

}


}