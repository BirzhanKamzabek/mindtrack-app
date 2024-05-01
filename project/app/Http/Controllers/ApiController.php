<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
use App\Models\Question;
use App\Models\Topic;
use App\Models\Test;
use App\Models\Meditation;
use App\Models\MeditationStep;
use Carbon\Carbon;
use App\Helpers\PushNotificationHelper;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ApiController extends Controller
{
    #register start here

    public function register(Request $request)
    {
        try {

            // Validate request
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'display_name' => 'unique:users,display_name'
            ]);

            // If display_name is not provided, generate one
            if (!empty($request->display_name)) {
                $displayName = $request->display_name;
            } else {
                $displayName = '@' . explode('@', $request->email)[0] . random_int(10, 99);
            }
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = random_int(100000000, 999999999) . '.' . $image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/images/'), $imageName);
            }

            // Create user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
                'display_name' => $displayName,
                'about_me' => $request->input('about_me'),
                'dob' => $request->input('dob'),
                'age' => $request->input('age'),
                'height' => $request->input('height'),
                'weight' => $request->input('weight'),
                'ethnicity' => $request->input('ethnicity'),
                'body_type' => $request->input('body_type'),
                'position' => $request->input('position'),
                'tribes' => $request->input('tribes'),
                'relationship_status' => $request->input('relationship_status'),
                'looking_for' => $request->input('looking_for'),
                'meet_at' => $request->input('meet_at'),
                'accept_nsfw_pics' => $request->input('accept_nsfw_pics'),
                'gender' => $request->input('gender'),
                'pronouns' => $request->input('pronouns'),
                'hiv_status' => $request->input('hiv_status'),
                'lab_tested' => $request->input('lab_tested'),
                'test_reminder_date' => $request->input('test_reminder_date'),
                'vaccination' => $request->input('vaccination'),
                'instagram' => $request->input('instagram'),
                'spotify' => $request->input('spotify'),
                'twitter' => $request->input('twitter'),
                'facebook' => $request->input('facebook'),
                'image_path' => $imagePath,
            ]);
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => $user,
                'token' => $token
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #Register end here

    public function user_register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 'failed'
            ], 422);
        }
    
        $user = new User;
        $user->role = 'user';
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
    
        if ($user->save()) {
            $token = $user->createToken('authToken')->plainTextToken;
            
            return response()->json([
                'token' => $token,
                'message' => 'User registered successfully',
                'user' => $user,
                'status' => 'success'
            ], 201);
        } else {
            return response()->json([
                'message' => 'User not registered successfully',
                'status' => 'failed'
            ], 500);
        }
    }
    

    public function login_action(Request $request) {

        $request->validate([
            'email' => 'required|email', 
            'password' => 'required',        
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('auth_token')->plainTextToken;
    

            return response()->json([
                'redirect' => 'Dashboard',
                'token' => $token,
                'role' => 'user',
                'user' => $user,
                'message' => 'Login Successful',
                'status' => 'Success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid email or password',
                'status' => 'Error'
            ], 401);
        }
    }

        
    #login api Email or Phone

    public function login(Request $request)
    {
        try {
            $request->validate([
                'login' => 'required',
                'password' => 'required',
            ]);

            $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

            $credentials = [
                $fieldType => $request->login,
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken($request->login)->plainTextToken;

                return response()->json([
                    'success' => true,
                    'message' => 'Login Successfully.',
                    'token' => $token
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid login credentials'
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    #login api Email or Phone

    #logout
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logout Successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    #logout
    #user profile Update

    public function user_profile_update(Request $request, $id)
    {
        try {
            // Ensure the request is authenticated
            // Validate request
            $request->validate([
                'name' => 'sometimes|required',
                'email' => 'sometimes|required|email|unique:users,email,' . $id,
                'phone' => 'sometimes|required|unique:users,phone,' . $id,
                'display_name' => 'sometimes|required|unique:users,display_name,' . $id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            // Find the user
            $user = User::findOrFail($id);
            // Update user data

            $check = $user->update([
                'name' => $request->input('name', $user->name),
                'email' => $request->input('email', $user->email),
                'phone' => $request->input('phone', $user->phone),
                'display_name' => $request->input('display_name', $user->display_name),
                'about_me' => $request->input('about_me', $user->about_me),
                'dob' => $request->input('dob', $user->dob),
                'age' => $request->input('age', $user->age),
                'height' => $request->input('height', $user->height),
                'weight' => $request->input('weight', $user->weight),
                'ethnicity' => $request->input('ethnicity', $user->ethnicity),
                'body_type' => $request->input('body_type', $user->body_type),
                'position' => $request->input('position', $user->position),
                'tribes' => $request->input('tribes', $user->tribes),
                'relationship_status' => $request->input('relationship_status', $user->relationship_status),
                'looking_for' => $request->input('looking_for', $user->looking_for),
                'meet_at' => $request->input('meet_at', $user->meet_at),
                'accept_nsfw_pics' => $request->input('accept_nsfw_pics', $user->accept_nsfw_pics),
                'gender' => $request->input('gender', $user->gender),
                'pronouns' => $request->input('pronouns', $user->pronouns),
                'hiv_status' => $request->input('hiv_status', $user->hiv_status),
                'lab_tested' => $request->input('lab_tested', $user->lab_tested),
                'test_reminder_date' => $request->input('test_reminder_date', $user->test_reminder_date),
                'vaccination' => $request->input('vaccination', $user->vaccination),
                'instagram' => $request->input('instagram', $user->instagram),
                'spotify' => $request->input('spotify', $user->spotify),
                'twitter' => $request->input('twitter', $user->twitter),
                'facebook' => $request->input('facebook', $user->facebook),
                'longitude' => $request->input('longitude', $user->longitude),
                'latitude' => $request->input('latitude', $user->latitude),
                'fcm_token' => $request->input('fcm_token', $user->fcm_token),
            ]);

            // Handle image update
            if ($request->hasFile('image')) {
                if ($user->image !== null) {
                    $getFilePath = public_path('uploads/images/') . $user->image;
                    if (file_exists($getFilePath)) {
                        unlink($getFilePath);
                    }
                }
                // Store the new image
                $image = $request->file('image');
                $imageName = random_int(100000000, 999999999) . '.' . $image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/images/'), $imageName);

                // Update the user with the new image path
                $user->update(['image' => $imageName]);
            }
            return response()->json([
                'success' => true,
                'message' => 'User Update  Successfully.',
                'update' => $check
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #user profile Update

    // Get Login User Details

    public function login_user()
    {

        try {
            $user = User::with('gallery')->find(auth()->user()->id);
            if ($user && $user->subscription && $user->subscription->isActive()) {
                $user->is_subscription = 'active';
            } else {
                $user->is_subscription = 'inactive';
            }
            if ($user && $user->gallery && $user->gallery->isNotEmpty()) {
                foreach ($user->gallery as $galleryItem) {
                    $galleryItem->image_path = asset('uploads/usergallery') . '/' . $galleryItem->image;
                    $galleryItem->makeHidden(['created_at', 'updated_at', 'user_id', 'image']);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Login User data',
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    // Get Login User Details
    // All User Details

    public function get_all_users()
    {

        try {
            $user = User::find(auth()->user()->id);
            if ($user && $user->subscription && $user->subscription->isActive()) {
                $users = User::where('role', 'user')->get();
                foreach ($users as $data) {
                    if ($data->last_seen >= Carbon::now()->subMinutes(2)) {
                        $online_status = 'online';
                    } else {
    
                        $online_status = 'offline';
                    }
                    $data->online_status = $online_status;
                }
                return response()->json([
                    'success' => true,
                    'message' => 'All Users',
                    'count' => $users->count(),
                    'data' => $users,
                ], 200);
            } else {
                $adsense = Adsense::where('status', 1)->get();
                foreach ($adsense as $data) {
                    $data->image_path = asset('admin/images/adsense') . '/' . $data->banner;
                    $data->makeHidden(['banner', 'created_at', 'updated_at']);
                }
                $users = User::where('role', 'user')->get();
                $Alluser = User::where('role', 'user')->count();
                $adsenseCounter = 0; // Counter to keep track of Adsense items
                $insertionIndex = 8; // Insert the first Adsense item after the 9th post
                
                // Iterate over users, keeping track of the index
                foreach ($users as $key => $data) {
                    if( $adsenseCounter == $adsense->count()){
                        $adsenseCounter = 0; 
                    }
                    if ($data->last_seen >= Carbon::now()->subMinutes(2)) {
                        $online_status = 'online';
                    } else {
                        $online_status = 'offline';
                    }
                    $data->online_status = $online_status;
                    $data->display = 'user'; // Set display key for user
                
                    // Check if the current index is the insertion index
                    if ($key == $insertionIndex) {
                        // Check if there's an Adsense item available
                        if (isset($adsense[$adsenseCounter])) {
                            // Insert Adsense item after every 9 users
                            $adsenseItem = $adsense[$adsenseCounter];
                            $adsenseItem->display = 'adsense'; // Set display key for adsense
                            $users->splice($key + 1, 0, [$adsenseItem]);
                            $adsenseCounter++;
                            $insertionIndex += 10; // Move insertion index by 10 for next Adsense insertion
                        }
                    }
                    
                }
                 
                return response()->json([
                    'success' => true,
                    'message' => 'All Users',
                    'count' => $Alluser,
                    'data' => $users,
                ], 200);
            }
           
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    // All User Details

    #view User Count
    public function user_view(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id'
            ]);

            $user = User::with('gallery')->where('id', $request->user_id)->first();
            $is_already = Viewed::where('view_by', Auth::id())->where('user_id', $request->user_id)->first();
            if (Auth::id() != $request->user_id && empty($is_already)) {
                Viewed::create([
                    'view_by' => Auth::id(),
                    'user_id' => $request->user_id
                ]);
            }
            if ($user->last_seen >= Carbon::now()->subMinutes(2)) {
                $online_status = 'online';
            } else {

                $online_status = 'offline';
            }
            $user->online_status = $online_status;
            if ($user && $user->gallery && $user->gallery->isNotEmpty()) {
                foreach ($user->gallery as $galleryItem) {
                    $galleryItem->image_path = asset('uploads/usergallery') . '/' . $galleryItem->image;
                    $galleryItem->makeHidden(['created_at', 'updated_at', 'user_id', 'image']);
                }
            }
            // Corrected update syntax
            return response()->json([
                'success' => true,
                'message' => 'User Details',
                'data' => $user,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #view User Count
    #viewed Users

    public function user_viewed_by(Request $request)
    {
        try {
            $user_id = Auth::id();
            $viewers =  Viewed::with('view_by')->where('user_id', $user_id)->get();
            $count =  Viewed::where('user_id', $user_id)->count();
            return response()->json([
                'success' => true,
                'message' => 'Viewed by Users',
                'totalViews' => $count,
                'data' => $viewers,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #viewed Users
    #Subscription List

    public function subscription_list()
    {
        try {
            $allPlans = SubscriptionPlans::where('status', 'active')->get();
            return response()->json([
                'success' => true,
                'message' => 'All Subscription Plans',
                'count' => count($allPlans),
                'data' => $allPlans,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    #Subscription List

    #user Gallery
    public function user_gallery(Request $request)
    {
        try {
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $user = auth()->user();
            foreach ($request->file('images') as $image) {
                $imageName = random_int(100000000, 999999999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/usergallery/'), $imageName);
                $gallery = UserGallery::create([
                    'user_id' => $user->id,
                    'image' => $imageName,
                ]);

                $uploadedImages[] = $gallery;
            }
            return response()->json([
                'success' => true,
                'message' => 'Images Uploded',
                'count' => count($uploadedImages),
                'data' => $uploadedImages,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #user Gallery Delete Array
    public function delete_user_gallery(Request $request)
    {
        try {
            $user_id = auth()->user()->id;
            $idArray = $request->image_ids;

            // Get the image names before deleting from the database
            $imageNames = UserGallery::where('user_id', $user_id)
                ->whereIn('id', $idArray)
                ->pluck('image')
                ->toArray();

            // Delete records from the database
            UserGallery::where('user_id', $user_id)
                ->whereIn('id', $idArray)
                ->delete();

            // Unlink files from the folder
            foreach ($imageNames as $imageName) {
                $filePath = public_path('uploads/usergallery/') . $imageName;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            return response()->json([
                'success' => true,
                'message' => count($idArray) . ' Gallery Images Deleted'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #user Gallery Delete Array

    #chats Code Start Here
    public function get_chats(Request $request)
    {

        try {
            $request->validate([
                'receiver_id' => 'required|exists:users,id',
            ]);
            $sender_id =  auth()->user()->id;
            $receiver_id = $request->receiver_id;

            // online status
            $user = User::find($request->receiver_id);
            if ($user->last_seen >= Carbon::now()->subMinutes(2)) {
                $online_status = 'online';
            } else {
                $lastSeenTime = \Carbon\Carbon::parse($user->last_seen)->diffForHumans();
                $online_status = 'Last Seen at ' . $lastSeenTime;
            }
            // online status

            $messages = Chats::with('sender', 'receiver')->where(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $sender_id)
                    ->where('receiver_id', $receiver_id);
            })->orWhere(function ($query) use ($sender_id, $receiver_id) {
                $query->where('sender_id', $receiver_id)
                    ->where('receiver_id', $sender_id);
            })->get();
            foreach ($messages as $message) {
                if ($message->file !== null) {
                    $message->file_path = asset('uploads/images/chats/' . $message->file);
                }
                if ($message->sender->image !== null) {
                    $message->sender->image_path = asset('uploads/images/' . $message->sender->image);
                }
                if ($message->receiver->image !== null) {
                    $message->receiver->image_path = asset('uploads/images/' . $message->receiver->image);
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'All Messsages',
                'online_status' => $online_status,
                'data' => $messages,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    #user Chats
    public function user_chats(Request $request)
    {
        try {
            $sender_id = auth()->user()->id;

            $interactedUsers = User::whereHas('sentMessages', function ($query) use ($sender_id) {
                $query->where('receiver_id', $sender_id);
            })->orWhereHas('receivedMessages', function ($query) use ($sender_id) {
                $query->where('sender_id', $sender_id);
            })->get();
            $interactedUsers->each(function ($user) {
                $messages = Chats::where('sender_id', $user->id)
                    ->where('receiver_id', Auth::id())
                    ->where('read', 0)

                    ->get();

                $messageCount = $messages->count();
                $latestMessage = $messageCount > 0 ? $messages->first()->message : null;

                $user->newMessageCount = $messageCount;
                $user->newMessage = $latestMessage;
            });

            return response()->json([
                'success' => true,
                'message' => 'Chat User List',
                'data' => $interactedUsers,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #user Chats
    #send Message
    public function sendMessage(Request $request)
    {
        try {
            $senderId = auth()->user()->id;
            $receiverId = $request->input('receiver_id');
            $message = $request->input('message');
            $location = $request->input('location');
            $request->validate([
                'receiver_id' => 'required',
            ]);
            $isCheck = User::where('id', $receiverId)->first();
            if (!$isCheck) {
                return response()->json([
                    'success' => false,
                    'message' => 'Receiver Not Found'
                ], 400);
            }
            if (empty($message) && !$request->hasFile('file') && empty($location)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Either message or image is required'
                ], 400);
            }
            $saveMsg = new Chats();
            $saveMsg->sender_id = $senderId;
            $saveMsg->receiver_id = $receiverId;

            // Check if the request has a file named 'image'
            if ($request->hasFile('file')) {
                $imageName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('uploads/images/chats'), $imageName);
                $saveMsg['file'] = $imageName;
            }

            if ($message) {
                $saveMsg->message = $message;
            }
            if ($location) {
                $saveMsg->location = $location;
            }

            $saveMsg->save();
            return response()->json([
                'success' => true,
                'message' => 'Message Sent'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #send Message

    #delete Message
    public function delete_message(Request $request)
    {
        try {
            $senderId = auth()->user()->id;
            $request->validate([
                'ids' => 'required',
            ]);
            Chats::where('sender_id', $senderId)->whereIn('id', $request->ids)->delete();
            return response()->json([
                'success' => true,
                'message' => count($request->ids) . ' Messsage Deleted'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #delete Message
    #Get Unread Message Count
    public function unread_message(Request $request)
    {
        try {
            $senderId = auth()->user()->id;
            $messageCount = Chats::where('receiver_id', $senderId)->where('read', 0)->count();
            $latestMessage = Chats::where('receiver_id', $senderId)->where('read', 0)->latest()->first();
            return response()->json([
                'success' => true,
                'unreadMessage' => $messageCount,
                'latestMessage' => $latestMessage
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #Get Unread Message Count

    #read Message
    public function read_message(Request $request)
    {
        try {
            $request->validate([
                'sender_id' => 'required'
            ]);
            $receiver_id = auth()->id();
            $sender_id = $request->sender_id;
            Chats::where('sender_id', $sender_id)->where('receiver_id', $receiver_id)->update(['read' => 1]);
            return response()->json([
                'success' => true,
                'message' => 'Message Read Successfully'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #read Message
    #chats Code Start Here

    #friend Request

    public function send_friend_request(Request $request)
    {
        try {
            $request->validate([
                'friend_id' => 'required',
            ]);
            $userId = auth()->id();
            $friendId = $request->input('friend_id');

            // Check if the friend request already exists in either direction
            $existingRequest = Friend::where(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $userId)
                    ->where('friend_id', $friendId);
            })->orWhere(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $friendId)
                    ->where('friend_id', $userId);
            })->first();

            if ($existingRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'Friend request already sent',
                ], 400);
            }
            Friend::create([
                'user_id'    => $userId,
                'friend_id'  => $request->input('friend_id'),
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Friend Request Send'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function accept_friend_request(Request $request)
    {
        try {
            $friendRequestId = $request->request_id;
            // Find the friend request by ID
            $friendRequest = Friend::find($friendRequestId);

            // Check if the friend request exists
            if (!$friendRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'Friend request not found',
                ], 404);
            }

            // Check if the authenticated user is the recipient of the friend request
            if (auth()->id() !== $friendRequest->friend_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized to accept this friend request',
                ], 403);
            }

            // Update the friend request to mark it as accepted
            $friendRequest->update(['status' => 'accept']);

            return response()->json([
                'success' => true,
                'message' => 'Friend request accepted',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function cancel_friend_request(Request $request)
    {
        try {
            $friendRequestId = $request->request_id;
            // Find the friend request by ID
            $friendRequest = Friend::find($friendRequestId);

            // Check if the friend request exists
            if (!$friendRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'Friend request not found',
                ], 404);
            }

            // Check if the authenticated user is the sender of the friend request
            if (auth()->id() !== $friendRequest->friend_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized to cancel this friend request',
                ], 403);
            }

            // Delete the friend request
            $friendRequest->delete();

            return response()->json([
                'success' => true,
                'message' => 'Friend request canceled',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function remove_friend(Request $request)
    {
        try {
            $userId = auth()->id();
            $friendId = $request->friend_id;
            // Find the friendship record
            $friendship = Friend::where(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $userId)
                    ->where('friend_id', $friendId);
            })->orWhere(function ($query) use ($userId, $friendId) {
                $query->where('user_id', $friendId)
                    ->where('friend_id', $userId);
            })->first();

            // Check if the friendship record exists
            if (!$friendship) {
                return response()->json([
                    'success' => false,
                    'message' => 'Friendship not found',
                ], 404);
            }

            // Delete the friendship record
            $friendship->delete();

            return response()->json([
                'success' => true,
                'message' => 'Unfriended successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function friend_request_list()
    {
        try {
            $userId = auth()->id();
            $list = Friend::with('user')->where('friend_id', $userId)->where('status', 'pending')->get();
            foreach ($list as $data) {
                if ($data->user->image !== null) {
                    $data->user->image_path = asset('uploads/images/') . '/' . $data->user->image;
                }
            }
            return response()->json([
                'success' => true,
                'message' => 'Friend Request List',
                'data' => $list
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function friends_list()
    {
        try {
            $userId = Auth::id();

            // Retrieve friends for the authenticated user
            $friends = Friend::where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('status', 'accept');
            })->orWhere(function ($query) use ($userId) {
                $query->where('friend_id', $userId)
                    ->where('status', 'accept');
            })->get();

            foreach ($friends as $friend) {
                if ($friend->user_id !== Auth::id()) {
                    $friend->friend =  User::where('id', $friend->user_id)->first(['id', 'name', 'image', 'display_name']);
                    $friend->friend->image_path = asset('uploads/images/') . '/' . $friend->friend->image;
                } else if ($friend->friend_id !== Auth::id()) {
                    $friend->friend = User::where('id', $friend->friend_id)->first(['id', 'name', 'image', 'display_name']);
                    $friend->friend->image_path = asset('uploads/images/') . '/' . $friend->friend->image;
                }
                $messageCount = Chats::where('receiver_id', Auth::id())->where('read', 0)->count();
                $latestMessage = Chats::where('receiver_id', Auth::id())->where('read', 0)->latest()->first();
                $friend->friend->new_message = $messageCount;
                $friend->friend->latestMessage = $latestMessage;
            }
            return response()->json([
                'success' => true,
                'message' => 'Friends List',
                'data' => $friends
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #friend Request

    #Subscription

    public function subscription_buy(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                'plan_id' => 'required|exists:subscription_plans,id',
            ]);
            $is_already = UserSubscription::where('user_id', $user_id)->where('status', 'active')->first();
            if ($is_already) {
                return response()->json([
                    'success' => false,
                    'message' => 'Subscription Already Active',
                ], 500);
            }
            $pay = true;
            if ($pay == true) {

                $plan = SubscriptionPlans::find($request->plan_id);
                $today_date = now();
                $expired_at = now()->addDays($plan->days);
                $transaction_id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 10);
                UserSubscription::create([
                    'plan_id' => $request->plan_id,
                    'user_id' => $user_id,
                    'started_at' => $today_date,
                    'expired_at' => $expired_at
                ]);
                SubscriptionInvoice::create([
                    'plan_id' => $request->plan_id,
                    'user_id' => $user_id,
                    'payment_date' => $today_date,
                    'days' => $plan->days,
                    'expired_at' => $expired_at,
                    'transaction_id' => $transaction_id,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Subscribe Successfully',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment Failed',
                ], 500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function subscription_upgrade(Request $request)
    {

        try {
            $user_id = Auth::id();
            $request->validate([
                'plan_id' => 'required|exists:subscription_plans,id',
            ]);
            $same_plan = UserSubscription::where('user_id', $user_id)->where('plan_id', $request->plan_id)->where('status', 'active')->first();
            if ($same_plan) {
                return response()->json([
                    'success' => false,
                    'message' => 'This Plan is Already Active',
                ], 500);
            }
            $existingSubscription = UserSubscription::where('user_id', $user_id)->where('status', 'active')->first();
            if ($existingSubscription) {
                $pay = true;
                if ($pay == true) {

                    $plan = SubscriptionPlans::find($request->plan_id);
                    $today_date = now();
                    $expired_at = now()->addDays($plan->days);
                    $transaction_id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 10);
                    $existingSubscription->update([
                        'plan_id' => $request->plan_id,
                        'expired_at' => $expired_at,
                    ]);
                    SubscriptionInvoice::create([
                        'plan_id' => $request->plan_id,
                        'user_id' => $user_id,
                        'payment_date' => $today_date,
                        'days' => $plan->days,
                        'expired_at' => $expired_at,
                        'transaction_id' => $transaction_id,
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Subscription Upgraded Successfully',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment Failed',
                    ], 500);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No active subscription found',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #Subscription
    #user favourite

    public function user_favourite_post(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                'friend_id' => 'required|exists:users,id',
            ]);
            if ($user_id == $request->friend_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Friend is Same as Login user.',
                ], 422);
            }
            if (Favourite::where('user_id', $user_id)->where('friend_id', $request->friend_id)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Friend is already in the favorites list.',
                ], 422);
            }
            Favourite::create([
                'user_id' => $user_id,
                'friend_id' => $request->friend_id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Added To Favourite',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function user_favourite()
    {
        try {
            $user_id = Auth::id();
            $list =  Favourite::with('friend')->where('user_id', $user_id)->get();
            return response()->json([
                'success' => true,
                'message' => 'Favourite List',
                'data' => $list
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #user favourite

    #user flame

    public function user_flame_post(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                'friend_id' => 'required|exists:users,id',
            ]);
            if ($user_id == $request->friend_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Friend is Same as Login user.',
                ], 422);
            }
            if (Flame::where('user_id', $user_id)->where('friend_id', $request->friend_id)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Friend is already in the favorites list.',
                ], 422);
            }
            Flame::create([
                'user_id' => $user_id,
                'friend_id' => $request->friend_id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Added To flame',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function user_flame()
    {
        try {
            $user_id = Auth::id();
            $list =  Flame::with('friend')->where('user_id', $user_id)->get();
            return response()->json([
                'success' => true,
                'message' => 'flame List',
                'data' => $list
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #user flame

    #user Filter

    public function user_filter(Request $request)
    {
        try {
            // Start with base query
            $query = User::query();

            // Apply filters
            $filters = $request->only([
                'name', 'email', 'phone', 'display_name', 'dob', 'about_me',
                'age', 'height', 'weight', 'ethnicity', 'body_type', 'position',
                'tribes', 'relationship_status', 'looking_for', 'meet_at',
                'accept_nsfw_pics', 'gender', 'pronouns', 'hiv_status',
                'lab_tested', 'test_reminder_date', 'vaccination'
            ]);

            foreach ($filters as $column => $value) {
                if ($value !== null) {
                    // Use where clause to filter by each column
                    $query->where($column, $value);
                }
            }
            if ($request->online) {
                $query->where('last_seen', '>=', Carbon::now()->subMinutes(2));
            }
            // Execute the query
            $results = $query->get();

            foreach ($results as $data) {
                if ($data->last_seen >= Carbon::now()->subMinutes(2)) {
                    $online_status = 'online';
                } else {

                    $online_status = 'offline';
                }
                $data->online_status = $online_status;
            }

            return response()->json([
                'success' => true,
                'message' => 'User List',
                'totalUser' => count($results),
                'data' => $results
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #user Filter

    #Push notification

    public function sendPushNotification(Request $request)
    {
        try {
            $title  = $request->title;
            $message  = $request->message;
            $image  = $request->image;
            $url  = $request->url;
            $fcm_token  = $request->fcm_token;
            $result = PushNotificationHelper::sendPushNotification($title, $message, $image, $url, $fcm_token);
            return response()->json([
                'success' => true,
                'message' => 'Notification',
                'data' => $result
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    #Push notification

    #mail
    public function sendMail(Request $request)
    {
        $recipient = 'sayhisaurabh@gmail.com';
        $subject = 'Subject of the Mail Dynamic';
        $data = [
            'name' => 'John Doe',
            'message' => 'This is a test email.'
        ];
        $view = 'register'; // Blade file name without extension

        // Call the helper function to send the email
        MailHelper::sendMail($recipient, $subject, $data, $view);

        return "Email sent successfully!";
    }
    #mail

    #forgot password api 

    public function forgot_password_otp(Request $request)
    {
      if($request->phone){
  
      $number = $request->phone;
      $isUser = User::where('phone', $number)->first();
  
      if ($isUser) 
      {
    $datas=array();
  
    $datas['password']=Hash::make($request->password);
  
    User::where('phone',$request->phone)->update($datas);
  
            return response([
            'message' => 'New Password Successfully',
            'status' => 'Success'
        ], 200);
      }
      else{
        return response([
          'message' => 'Phone number Not Exist ',
          'status' => 'failed'
      ], 200);
      }
    }
  
  else
  {
    $email = $request->email;
    $isUser = User::where('email', $email)->first();
  
    if ($isUser) 
    {
  $datas=array();
  
  $datas['password']=Hash::make($request->password);
  
  User::where('email',$request->email)->update($datas);
  
        return response([
            'message' => 'New Password Successfully',
            'status' => 'Success'
        ], 200);
        }
        else
        {
          return response([
            'message' => 'Email number Not Exist ',
            'status' => 'failed'
        ], 200);
        }
      }
  
  
    }

    public function me()
    {
          $user =auth()->user();
            return response()->json([
                'user' => $user,
                'status' => 'success',
            ], 200);    
    }

    function all_questions(){
        $questions=Question::paginate(1);
             return response([
            'data' => $questions,
            'status' => 'Success'
        ], 200);
     }

     function single_question($id){

        $question=Question::where('id',$id)->first();
             return response([
            'data' => $question,
            'status' => 'Success'
        ], 200);

     }

     function add_test(Request $request){
        try {
            $user_id = auth()->user()->id;
    
            $existingEntry = Test::where('user_id', $user_id)
                                ->where('question_id', $request->question_id)
                                ->where('topic_id', $request->topic_id)
                                ->first();
        
            if ($existingEntry) {
                return response()->json(['status' => 'failed', 'message' => 'You have already attempted this question!']);
            }
        // dd($request->all());
            for ($i = 0; $i < count($request->question_id); $i++) {
        
                $data = new Test;
        
                $data->user_id = $user_id;
                $data->question_id = $request->question_id[$i];
                $data->topic_id = $request->topic_id;
                $data->answer = $request->answer[$i];
        
                $check = $data->save();
        
    
                if (!$check) {
            
                    return response()->json(['status' => 'failed', 'message' => 'Failed to add data!']);
                }
            }
        
            return response()->json(['status' => 'success', 'message' => 'You have successfully added!']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);  
        }


    }
    

    
public function update_profile(Request $request){

    $dataArray = array();

     $id = auth()->user()->id;
  
    $dataArray['name'] = $request->name;
    $dataArray['email'] = $request->email;
  
  if(isset($request->image)){
          $imageName = time().'.'.$request->image->extension();  
          $request->image->move(public_path('uploads/images/'), $imageName); 
         $dataArray['image']=$imageName;
      }
  
  $check = User::where('id', $id)->update($dataArray);
  if($check){
      return response([
            'message'=>'Updated Succesfully',
            'status'=>'success'
      ],201);
    }

    else{
   return response([
            'message'=>'Not Updated Succesfully',
            'status'=>'Failed'
      ],201);
    }
    } 

public function all_topics(){
    $topics  = Topic::get();
    return response([
        'success'=>true,
        'message'=>'All Topics List',
        'data' =>$topics
  ],200);
}
public function topics_questions($id){
    $userId = Auth::id();
    $topic = Topic::find($id);
    $questions  = Question::where('topic_id',$id)->get();
    $passedQuestions = Test::where('user_id', $userId)->pluck('question_id')->toArray();
    foreach ($questions as $question) {
        $question->attempt = in_array($question->id, $passedQuestions);
    }
    return response([
        'success'=>true,
        'message'=> $topic->title.' Questions',
        'count' =>$questions->count(),
        'data' =>$questions
  ],200);
}
    
public function test_result($topic_id) {
    $user_id = Auth::id();  // Получаем ID текущего пользователя
    $tests = Test::with('question.answers')->where('user_id', $user_id)->where('topic_id', $topic_id)->get();
    $totalScore = 0;

    foreach ($tests as $test) {
        // Предполагаем, что ответы упорядочены и ID ответа соответствует порядку его представления
        $index = $test->question->answers->search(function ($answer) use ($test) {
            return $answer->id === $test->answer_id;
        });

        // Назначаем баллы в зависимости от порядка ответа
        $test->score = $index; // Индекс начинается с 0, что соответствует вашим требованиям
        $totalScore += $test->score; // Суммируем общий счёт
    }

    // Здесь можно добавить логику сохранения результатов, если это необходимо
    // Например, сохранить итоговый счёт теста или подробные результаты каждого ответа

    return response([
        'success' => true,
        'message' => 'Results calculated successfully',
        'total_score' => $totalScore,  // Возвращаем общий счёт теста
        'data' => $tests
    ], 200);
}



    #Meditation

    public function meditation_list(){
        try {
         $list = Meditation::get();
         return response([
            'success'=>true,
            'message'=> 'All List',
            'video_path' => asset('admin/meditation/videos'),
            'image_path' => asset('admin/meditation/images'),
            'count' =>$list->count(),
            'data' =>$list
      ],200); 
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function meditation_list_popular(){
        try {
         $list = Meditation::orderBy('popular','DESC')->get();
         return response([
            'success'=>true,
            'message'=> 'All List',
            'video_path' => asset('admin/meditation/videos'),
            'image_path' => asset('admin/meditation/images'),
            'count' =>$list->count(),
            'data' =>$list
      ],200); 
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function meditation_single($id){
        try {
         $list = Meditation::with('steps')->find($id);
         $list->popular = ($list->popular + 1);
         $list->save();
         return response([
            'success'=>true,
            'message'=> 'Meditation Details',
            'video_path' => asset('admin/meditation/videos'),
            'image_path' => asset('admin/meditation/images'),
            'data' =>$list
      ],200); 
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function user_tests(){
        try {
            $user_id = Auth::id();
         $list = Test::with('question')->where('user_id',$user_id)->get();
         $correctCount = 0;
         $incorrectCount = 0;
         foreach($list as $test){
            if($test->answer == $test->question->answer){
                $test->result = 'Correct';
                $correctCount++;
            }else{
                $test->result = 'Incorrect';
                $incorrectCount++;
            }
         }
         return response([
            'success'=>true,
            'message'=> 'Meditation Details',
            'count' => $list->count(),
            'correct_count' => $correctCount,
            'incorrect_count' => $incorrectCount,
            'data' =>$list
      ],200); 
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
