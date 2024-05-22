<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EventAttendee;

class StudentController extends Controller
{
    public function index() {
        // Retrieve students with the role 'student'
        $students = User::where('role', 'student')->get();
    
        // Initialize an array to store the count of event attendees for each student
        $eventAttendeesCount = [];
    
        // Loop through each student
        foreach ($students as $student) {
            // Count the number of event attendees for the current student
            $attendeeCount = EventAttendee::where('student_id', $student->id)->count();
    
            // Store the count in the array with the student's ID as the key
            $eventAttendeesCount[$student->id] = $attendeeCount;
        }
    
        // Pass the students and event attendees count to the view
        return view('students.index', compact('students', 'eventAttendeesCount'));
    }

    public function delete(Request $request){
        $clubs = User::find($request->id);
        $clubs->delete();
        return redirect()->back();
    }
    
}
