<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPlans;
use App\Models\UserGallery;
use App\Models\Chats;
use App\Models\Friend;
use App\Models\Flame;
use App\Models\Favourite;
use App\Models\Viewed;
use App\Models\UserSubscription;
use App\Models\SubscriptionInvoice;
use App\Models\Adsense;
use Carbon\Carbon;
use App\Helpers\PushNotificationHelper;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class FrontendController extends Controller
{

    public function home()
    {
        $users = User::where('role', 'user')->take(12)->get();
        $plans = SubscriptionPlans::where('status', 'active')->get();

        return view('index', compact('users', 'plans'));
    }
    function contactEmail(Request $request)
    {
        try {
            DB::table('contacts_enquiry')->insert([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'message' => $request->input('message'),
            ]);

            $recipient = $request->email;
            $subject = 'Enquiry Mail';
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'message' => $request->message,
            ];
            $view = 'register'; // Blade file name without extension

            // Call the helper function to send the email
            MailHelper::sendMail($recipient, $subject, $data, $view);
            return response()->json([
                'success' => true,
                'message' => 'We Will Contact You Soon',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

public function about(){

    return view('about');
}
public function contact(){

    return view('contact');
}
public function members(){
    $users = User::where('role', 'user')->take(12)->get();
    return view('members',compact('users'));
}
public function membership(){
    $plans = SubscriptionPlans::where('status', 'active')->get();
    return view('membership',compact('plans'));
}
public function privacy_policy(){

    return view('privacy_policy');
}
public function terms_and_conditions(){

    return view('terms_and_conditions');
}
// public function about(){
//     $users = User::where('role', 'user')->take(12)->get();
//     $plans = SubscriptionPlans::where('status', 'active')->get();

//     return view('about', compact('users', 'plans'));
// }

}
