<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Event;
use App\Models\Club;
use App\Models\User;
use App\Models\EventAttendee;

class EventController extends Controller
{
    
    public function view($eventId)
    {
        // Find the event by its ID
        $event = Event::findOrFail($eventId);
        
        $attendees = $event->attendees;
        $student_id = auth()->id();
        $eventAttendees = EventAttendee::where('student_id', $student_id)->where('event_id', $eventId)->exists();
        
        return view('events.view', compact('event', 'attendees', 'eventAttendees'));
    }
    
    

    public function store(Request $request): RedirectResponse
    {
    
        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'start_date' => ['required', 'date', 'max:255'],
        'end_date' => ['required', 'date', 'max:255', 'after_or_equal:start_date'],
        'start_time' => ['required', 'string', 'max:255'],
        'end_time' => ['required', 'string', 'max:255', ],
        'venue' => ['required', 'string', 'max:255'],
        'club_id' => ['required', 'integer'], 
        'coordinator_id' => ['required', 'integer'], 
        'color' => ['required', 'string'], 
        'description' => ['string', 'max:500'],
        'image' => ['required', 'image', 'max:5048'], 
        'selected_students' => ['required', 'string', 'max:255']
        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images/event_images'), $newImageName);

        // Create a new club instance
        $club = new Event();
        $club->name = $request->name;
        $club->start_date = $request->start_date;
        $club->end_date = $request->end_date;
        $club->start_time = $request->start_time;
        $club->end_time = $request->end_time;
        $club->venue = $request->venue;
        $club->club_id = $request->club_id;
        $club->color = $request->color;
        $club->description = $request->description;
        $club->image = $newImageName;
        $club->status = 0;
        $club->coordinator_id = $request->coordinator_id;
        $club->visible_to = $request->selected_students;
        $club->save();
        
        // Redirect back with a success message
        return redirect()->route('events.add')->with('success', 'Event registered successfully!');
    }

    public function register(Request $request)
    {
        // Get the user ID
        $userId = auth()->id();

        // Get the event ID from the request data
        $eventId = $request->input('eventId');

        // Check if the user is already registered for the event
        $existingRegistration = EventAttendee::where('student_id', $userId)
                                            ->where('event_id', $eventId)
                                            ->exists();

        // If the user is already registered, return an error response
        if ($existingRegistration) {
            return response()->json(['error' => 'User is already registered for this event'], 400);
        }

        // If the user is not already registered, create a new registration entry
        EventAttendee::create([
            'student_id' => $userId,
            'event_id' => $eventId,
        ]);

        // Return a success response with a 201 Created status code
        return response()->json(['success' => 'Registered Successfully!'], 201);
    }



    public function show()
    {
        $userId = auth()->id();
        $events = Event::with('club')->get();
        $specific_events = Event::where('coordinator_id', $userId)->with('club')->get();
        $coordinatorName = User::where('id', $userId)->value('name');
        
        $studentEvents = Event::whereRaw("FIND_IN_SET(?, visible_to)", [$userId])->where('status', 1)->whereDate('start_date', '>', now())->get();

        return view('events.index', compact('events', 'specific_events', 'coordinatorName', 'studentEvents'));
    }

    public function list() {
        $events = Event::with('club')->get();
        return view('events.list', compact('events'));
    }

    public function edit($id)
    {
        $event = Event::with('club')->get();

        $coordinatorId = auth()->id();

        return view('events.edit', compact('event'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'club_id' => ['required', 'integer'],
            'venue' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'string', 'max:255'],
            'end_date' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'string', 'max:255'],
            'end_date' => ['required', 'string', 'max:255'],
            'image' => 'nullable|mimes:jpg,jpeg,png,svg|max:5048',
            'color' => ['required', 'string', 'max:255'],
        ]);

        // Find the Event by its ID
        $event = Event::find($request->id);

        // Check if the Event exists
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        // Update the club's name and description
        $event->name = $request->name;
        $event->club_id = $request->club_id;
        $event->description = $request->description;
        $event->venue = $request->venue;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->color = $request->color;

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            // Delete the old logo file if it exists
            if ($event->image && file_exists(public_path('images/event_images/' . $event->image))) {
                unlink(public_path('images/event_images/' . $event->image));
            }

            // Store the new logo file
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images/event_images/'), $newImageName);
            $event->image = $newImageName;
        }

        // Save the changes
        $event->save();

        return redirect()->back()->with('success', 'Event updated successfully!');
    }

    public function approveReject(Request $request) {
        // Retrieve the approval status and data ID from the form
        $approvalStatus = $request->input('approval_status');
        $dataId = $request->input('data_id');
        
        $event = Event::find($dataId);
        $event->status = $approvalStatus;

        $event->save();
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
    
    public function delete(Request $request){
        $clubs = Event::find($request->id);
        $clubs->delete();
        return redirect()->back();
    }
}
