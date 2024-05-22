<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Club;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules;
use Hash;

class CoordinatorController extends Controller
{
    public function store(Request $request): RedirectResponse
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'clubs' => ['array', 'required'], 
            'coordinator_id' => ['required', 'unique:users,student_id'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'coordinator',
            'student_id' => $request->coordinator_id,
            'phone' => $request->phone,
            'clubs' => implode(',', $request->clubs)
        ]);

        return redirect()->route('coordinators.add')->with('success', 'Coordinator Registration successful!');
    }


    public function show()
    {
        $coordinators = User::where('role', 'coordinator')->get();
        $clubs = Club::all();
        return view('coordinators.index', compact('coordinators', 'clubs'));
    }

    public function edit($id)
    {
        $coordinator = User::find($id);
        return view('coordinators.edit', compact('coordinator'));
    }
    
    public function update(Request $request){
        $coordinators = User::find($request->id);
        $coordinators->update([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->coordinator_id,
            'phone' => $request->phone,
        ]);
        return redirect()->back()->with('success', 'Coordinator updated successfully!');
    }

    public function delete(Request $request){
        $coordinators = User::find($request->id);
        $coordinators->delete();
        return redirect()->back();
    }

    public function view($id) {
        $coordinator = User::find($id);
        
        $events = Event::where('coordinator_id', $id)->count();
        $approvedEvents = Event::where('coordinator_id', $id)->where('status', '1')->count();
        $pendingEvents = Event::where('coordinator_id', $id)->where('status', '1')->count();

        $clubIds = explode(',', $coordinator->clubs);
        $clubs = Club::whereIn('id', $clubIds)->pluck('name');
    

        return view('coordinators.view', compact('coordinator', 'clubs', 'events', 'approvedEvents', 'pendingEvents'));
    }
    


}
