<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Club;
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

    public function edit($id) {
        $student = User::where('role', 'student')->where('id', $id)->first();

        return view('students.edit', compact('student'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'member_role' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
        ]);

        // Find the Event by its ID
        $student = User::find($request->id);

        // Check if the Event exists
        if (!$student) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        // Update the club's name and description
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->member_role = $request->member_role;
        $student->course = $request->course;


        $student->save();

        return redirect()->back()->with('success', 'Student updated successfully!');
    }

    public function view($id) {
        $student = User::where('role', 'student')->where('id', $id)->first();

        $associatedClubs = User::find($id);

        $clubIds = explode(',', $associatedClubs->clubs);
        
        $clubs = Club::whereIn('id', $clubIds)->get();

     
        return view('students.view', compact('student', 'clubs'));

    }


    
}
