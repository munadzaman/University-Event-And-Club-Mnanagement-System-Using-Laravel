<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Event;
use App\Models\Club;


class DashboardController extends Controller
{
    public function index() {
        //admin
        $totalEvents = Event::count();
        $pendingEvents = Event::where('status', '0')->count();
        $rejectedEvents = Event::where('status', '2')->count();
        $upcomingEvents = Event::where('start_date', '>', now())->orderBy('id')->count();
        $pastEvent = Event::where('end_date', '>', now())->orderBy('id')->count();
        $clubCount = Club::count();
        $studentCount = User::where('role', 'student')->count();
        $coordinatorCount = User::where('role', 'coordinator')->count();

        //club coordinator
        $coordinatorId = auth()->id();
        $specificPendingEvents = Event::where('coordinator_id', $coordinatorId)->count();
        $specificUpcomingEvents = Event::where('start_date', '>', date('Y-m-d'))->where('coordinator_id', $coordinatorId)->where('status', '1')->count();
        $specificPastEvents = Event::where('start_date', '<', date('Y-m-d'))->where('coordinator_id', $coordinatorId)->where('status', '1')->count();
        $specificRejectedEvents = Event::where('status', '2')->count();
        $specificTotalEvents = Event::where('coordinator_id', $coordinatorId)->count();

        $user = User::findOrFail($coordinatorId);
        $clubIds = explode(',', $user->clubs);
        $specificClubs = Club::whereIn('id', $clubIds)->pluck('name')->count();
        
        
        
        
        return view('dashboard', [
            //admin
            'totalEvents' => $totalEvents,
            'pendingEvents' => $pendingEvents,
            'rejectedEvents' => $rejectedEvents,
            'pastEvent' => $pastEvent,
            'upcomingEvents' => $upcomingEvents,
            'clubCount' => $clubCount,
            'studentCount' => $studentCount,
            'coordinatorCount' => $coordinatorCount,
            
            //club Coordinator
            'specificPendingEvents' => $specificPendingEvents,
            'specificUpcomingEvents' => $specificUpcomingEvents,
            'specificPastEvents' => $specificPastEvents,
            'specificRejectedEvents' => $specificRejectedEvents,
            'specificTotalEvents' => $specificTotalEvents,
            'specificClubs' => $specificClubs,



            
        ]);
    }
}
