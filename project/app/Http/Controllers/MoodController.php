<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;

class MoodController extends Controller
{
    public function index()
    {
        $moods = Mood::all();
        return response()->json($moods);
    }

    public function store(Request $request)
    {
        

        $mood = new Mood(); 
    $mood->date = $request->date; 
    $mood->mood = $request->mood; 
    $mood->user_id = $request->user_id;  // Ensure user_id is also handled if required 
    $mood->save(); 
 
    return response()->json($mood);
    }

    public function show(Mood $mood)
    {
        return response()->json($mood);
    }

    public function update(Request $request, Mood $mood)
    {
        $request->validate([
            'date' => 'required|date',
            'mood' => 'string'
        ]);

        $mood->update($request->all());
        return response()->json($mood);
    }

    public function destroy(Mood $mood)
    {
        $mood->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
