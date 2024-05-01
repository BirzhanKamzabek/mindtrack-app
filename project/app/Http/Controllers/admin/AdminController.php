<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SubscriptionPlans;
use App\Models\Adsense;
use App\Models\Question;
use App\Models\Meditation;
use App\Models\MeditationStep;
use App\Models\Topic;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Str;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
     function index(){
        return view('admin.dashboard');
     }


 

function all_users(){
    
    $data = User::where('role','user')->get();
    return view('admin.users.list',compact('data'));
}

function edit_user($id){
    
    $data = User::where('id',$id)->first();
    return view('admin.users.edit',compact('data'));
}
function delete_user($id){
    
    $data = User::where('id',$id)->delete();
    return redirect()->back()->with('success', 'Delete successfully!');
}
function setting(){
    
    $user_id=auth()->user()->id;
    $data = User::where('id',$user_id)->first();
    return view('admin.setting',compact('data'));
}


public function setting_action(Request $request){

    $dataArray = array();
   
    $dataArray['name']=$request->name;
    $dataArray['email']=$request->email;
    $dataArray['phone']=$request->phone;
    $dataArray['address']=$request->address;

    if(isset($request->image)){
       $imageName = time().'.'.$request->image->extension();  
       $request->image->move(public_path('admin/images'), $imageName); 
       $dataArray['image']= $imageName;
   }
   
   $check = User::where('id', $request->user_id)->update($dataArray);
   
   if($check){
   return redirect()->back()->with('success', 'You have successfully updated!');
   }
   else{
   return redirect()->back()->with('failed', 'You have not successfully updated!');
   }
   
   }


public function edit_user_action(Request $request){

 $dataArray = array();

 $dataArray['name']=$request->name;
 $dataArray['email']=$request->email;
 $dataArray['phone']=$request->phone;
 $dataArray['gender']=$request->gender;
 if(isset($request->image)){
    $imageName = time().'.'.$request->image->extension();  
    $request->image->move(public_path('admin/images'), $imageName); 
    $dataArray['image']= $imageName;
}

$check = User::where('id', $request->user_id)->update($dataArray);

if($check){
return redirect()->back()->with('success', 'You have successfully updated!');
}
else{
return redirect()->back()->with('failed', 'You have not successfully updated!');
}

}


function change_password(){
    return view('admin.change-password');
}
public function change_password_action(Request $request){

    $validator = \Validator::make($request->all(), [
        'current_password' => 'required',
        'password' => 'required|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect('/admin/change-password')
            ->withErrors($validator)
            ->withInput();
    }

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return redirect('/admin/change-password')
            ->withErrors(['current_password' => 'The provided password does not match your current password.'])
            ->withInput()
            ->with('status', 'Failed');
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect('/admin/change-password')->with('success', 'Password Change Successfully!');
}


  
#questions
 
 

function add_questions(){
    $topics=Topic::get();
    return view('admin.questions.add',compact('topics'));
}
function edit_questions ($id){
    $topics=Topic::get();
    $question=Question::find($id);
    return view('admin.questions.edit',compact('question','topics'));
}

function all_questions(){
   
   $questions=Question::with('topic')->get();
    return view('admin.questions.list',compact('questions'));
}
function delete_questions($id){
    Question::where('id',$id)->delete();
    return redirect()->back()->with('success', 'Successfully deleted!');
}
function add_questions_action(Request $request){

    $datas=new Question;
    $datas->topic_id=$request->topic_id;
    $datas->question=$request->question;
    $datas->option1=$request->option1;
    $datas->option2=$request->option2;
    $datas->option3=$request->option3;
    $datas->option4=$request->option4;
    $datas->answer=$request->answer;

    $check=$datas->save();

    if($check)
    {
        return redirect()->back()->with('success', 'You have successfully added!');
    }
    else
    {    
        return redirect()->back()->with('Failed', 'You have Not added!');
    }  
    }

    function edit_questions_action(Request $request){
        // Retrieve the question you want to edit
        $question = Question::find($request->question_id);
    
        if (!$question) {
            return redirect()->back()->with('error', 'Question not found!');
        }
    
        // Update the question fields with the new values from the request
        $question->topic_id = $request->topic_id;
        $question->question = $request->question;
        $question->answer = $request->answer;
    
        // Save the updated question
        $check = $question->save();
    
        if ($check) {
            return redirect('admin/questions/list')->with('success', 'Question updated successfully!');
        } else {    
            return redirect()->back()->with('error', 'Failed to update the question!');
        }  
    }

#Topics

public function topics(Request $request){
    $topics = Topic::with('lession')->get();
    return view('admin.topics.list', compact('topics'));
}

 
public function topic_lession($id){
     $topic = Topic::where('name',$id)->first();
    $lessions = Lession::with('topic')->where('topic_id',$topic->id)->get();
    return view('admin.topics.list-lession', compact('lessions','topic'));
}
function add_topics(){
    return view('admin.topics.add');
}
 

public function add_topics_action(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
    ]);
        $datas = new Topic;
        // Assigning values to other fields
        $datas->name = $request->name;
        $datas->description = $request->description;
        $check = $datas->save();
        

if($check){
    return redirect()->back()->with('success', 'You have successfully added!');
}
else{
    return redirect()->back()->with('error', 'You have Not added!');
}

}

function delete_topics($id){
    Topic::where('id',$id)->delete();
    return redirect()->back()->with('success', 'Successfully deleted!');
}

function edit_topics($id){
    $topic = Topic::find($id);
    return view('admin.topics.edit',compact('topic'));
}

function edit_topics_action(Request $request){
    $id = $request->input('topic_id'); 
   $topic  = Topic::find($id);
$topic->name = $request->name;
$topic->description = $request->description;
$check = $topic->save();
if ($check) {
    return redirect('admin/topics')->with('success', 'Successfully updated!');
} else {
    return redirect()->back()->with('error', 'Not updated!');
}
          
}
#result
public function submit_test(Request $request) {
    $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required|integer', // Убедитесь, что ответы - это числа
    ]);

    $score = 0;
    foreach ($request->answers as $questionId => $answer) {
        $score += $answer; // Подсчитываем сумму баллов
    }

    $resultText = $this->determineResult($score); // Определяем результат на основе суммы баллов

    $testResult = new TestResult([
        'user_id' => auth()->id(),
        'score' => $score,
        'result_text' => $resultText
    ]);
    $testResult->save();

    return redirect()->back()->with('success', 'Test submitted successfully! Your score: ' . $score);
}

protected function determineResult($score) {
    // Здесь ваша логика для определения результата по шкале Бека
    if ($score <= 10) return "Minimal depression";
    if ($score <= 18) return "Mild depression";
    if ($score <= 29) return "Moderate depression";
    if ($score <= 35) return $resultText;
    return ;
}

 
#Meditation

public function meditation(){
    $lists = Meditation::with('steps')->get();
    return view('admin.meditation.list',compact('lists'));
}
public function add_meditation(){
    return view('admin.meditation.add');
}
public function edit_meditation($id){
    $meditation = Meditation::with('steps')->find($id);
    return view('admin.meditation.edit',compact('meditation'));
}
public function meditation_step_list($id){
    $meditation = Meditation::find($id);
    $steps = MeditationStep::where('meditation_id',$id)->get();
    return view('admin.meditation.list-steps',compact('steps','meditation'));
}

function delete_meditation_step($id){
    MeditationStep::where('id',$id)->delete();
    return redirect()->back()->with('success', 'Successfully deleted!');
}
public function add_meditation_action(Request $request){
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'video' => 'required',
            'step_title.*' => 'required',
        ]);

        $videoName = '';
        $imageName = '';
        if(isset($request->video)){
            $videoName = uniqid().'.'.$request->video->extension();  
            $request->video->move(public_path('admin/meditation/videos'), $videoName); 
        }
        
        if(isset($request->image)){
            $imageName = uniqid().'.'.$request->image->extension();  
            $request->image->move(public_path('admin/meditation/images'), $imageName); 
        }

        // Start a database transaction
        DB::beginTransaction();
        
        $meditation = Meditation::create([
            'title' => $request->title,
            'description' => $request->description,
            'video' => $videoName,
            'image' => $$imageName,
        ]);

        $meditation_id = $meditation->id;

        if(isset($request->step_title) && is_array($request->step_title)) {
            foreach($request->step_title as $title) {
                MeditationStep::create([
                    'meditation_id' => $meditation_id,
                    'title' => $title,
                ]);
            }
        }

        // If everything goes well, commit the transaction
        DB::commit();

        // Redirect with success message
        return redirect()->back()->with('success', 'Meditation added successfully');
        
    } catch (\Throwable $th) {
        // If an error occurs, rollback the transaction
        DB::rollBack();
        // Redirect back with error message
        return redirect()->back()->with('error', $th->getMessage());
    }
}

 



public function edit_meditation_action(Request $request){
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'video' => 'nullable',
            'step_title.*' => 'required',
        ]);

        // Retrieve the existing meditation record
        $meditation = Meditation::findOrFail($request->meditation_id);

        // Update the fields if they are provided in the request
        $meditation->title = $request->title;
        $meditation->description = $request->description;

        // If a new video file is provided, move it to the appropriate directory
        if($request->hasFile('video')) {
            $videoName = uniqid().'.'.$request->video->extension();
            $request->video->move(public_path('admin/meditation/videos'), $videoName);
            $meditation->video = $videoName;
        }
        if($request->hasFile('image')) {
            $imageName = uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('admin/meditation/images'), $imageName);
            $meditation->image = $imageName;
        }

        // Start a database transaction
        DB::beginTransaction();
        
        // Save the updated meditation record
        $meditation->save();

           // Process the step titles
           if(isset($request->step_title) && is_array($request->step_title)) {
            foreach($request->step_title as $key => $title) {
                $stepId = $request->step_id[$key] ?? null;

                // Use updateOrCreate to update existing records or create new ones
                MeditationStep::updateOrCreate(
                    ['id' => $stepId], // Conditions for updating
                    ['meditation_id' => $meditation->id, 'title' => $title] // Data to insert if no matching records are found
                );
            }
        }

        // If everything goes well, commit the transaction
        DB::commit();

        // Redirect with success message
        return redirect()->back()->with('success', 'Meditation updated successfully');
        
    } catch (\Throwable $th) {
        // If an error occurs, rollback the transaction
        DB::rollBack();
        // Redirect back with error message
        return redirect()->back()->with('error', $th->getMessage());
    }
}

 
}
