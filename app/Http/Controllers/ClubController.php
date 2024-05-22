<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

class ClubController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'logo' => 'required|mimes:jpg,jpeg,png,svg|max:5048'
        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->logo->extension();
        $request->logo->move(public_path('images/club_logos'), $newImageName);

        // Create a new club instance
        $club = new Club();
        $club->name = $request->name;
        $club->description = $request->description;
        $club->logo = $newImageName;
        $club->save();

        // Redirect back with a success message
        return redirect()->route('clubs.add')->with('success', 'Club registered successfully!');
    }

    public function show()
    {
        $coordinatorId = auth()->id();

        // Retrieve all clubs
        $clubs = Club::all();

        // Retrieve specific clubs associated with the coordinator
        $user = User::findOrFail($coordinatorId);
        $specificClubIds = explode(',', $user->clubs);
        $specificClubs = Club::whereIn('id', $specificClubIds)->get();

        return view('clubs.index', compact('clubs', 'specificClubs'));
    }


    public function view($id) {
        $club = Club::find($id);
        $users = User::where('clubs', 'like', '%' . $id . '%')->get();
        
        $events = Event::where('club_id', $id)->get();

        return view('clubs.view', compact('club', 'users', 'events'));
    } 
    
    

    public function edit($id)
    {
        $club = Club::find($id);
        return view('clubs.edit', compact('club'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'logo' => 'nullable|mimes:jpg,jpeg,png,svg|max:5048',
        ]);

        // Find the club by its ID
        $club = Club::find($request->id);

        // Check if the club exists
        if (!$club) {
            return redirect()->back()->with('error', 'Club not found.');
        }

        // Update the club's name and description
        $club->name = $request->name;
        $club->description = $request->description;

        // Check if a new logo file has been uploaded
        if ($request->hasFile('logo')) {
            // Delete the old logo file if it exists
            if ($club->logo && file_exists(public_path('images/club_logos/' . $club->logo))) {
                unlink(public_path('images/club_logos/' . $club->logo));
            }

            // Store the new logo file
            $newImageName = time() . '-' . $request->name . '.' . $request->logo->extension();
            $request->logo->move(public_path('images/club_logos'), $newImageName);
            $club->logo = $newImageName;
        }

        // Save the changes
        $club->save();

        return redirect()->back()->with('success', 'Club updated successfully!');
    }


    public function delete(Request $request){
        $clubs = Club::find($request->id);
        $clubs->delete();
        return redirect()->back();
    }
}
