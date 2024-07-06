<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    public function index(){
        $news = News::all();
        return view('news.index', compact('news'));
    }

    // Show the edit form
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', compact('news'));
    }


    // Handle the update request
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $news = News::findOrFail($id);
        $news->title = $request->input('title');
        $news->date = $request->input('date');
        $news->category = $request->input('category');
        $news->description = $request->input('description');

        // Handling multiple images upload
        if ($request->hasFile('image')) {
            $images = [];
            foreach ($request->file('image') as $file) {
                $path = $file->store('public/images/news_images');
                $images[] = basename($path);
            }
            $news->image = $images;
        }

        $news->save();

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function store(Request $request): RedirectResponse
{
    // Validate the request
    $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'date' => ['required', 'date'],
        'description' => ['required', 'string', 'max:2000'],
        'category' => ['required', 'string', 'max:255'],
        'image' => ['required', 'array', 'min:3'],
        'image.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
    ], [
        'image.min' => 'The news must have at least 3 images.'
    ]);

    // Create a new news item
    $news = new News();
    $news->title = $request->title;
    $news->date = $request->date;
    $news->description = $request->description;
    $news->category = $request->category;

    $imagePaths = [];

    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $image) {
            $newImageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/news_images'), $newImageName);
            $imagePaths[] = $newImageName;
        }
    }

    $news->image = json_encode($imagePaths);
    $news->save();

    // Redirect to a route after successfully storing the news
    return redirect()->route('news.add')->with('success', 'News added successfully!');
}


    public function view($id){
        $news = News::find($id);
        return view('news.view' ,compact('news'));
    }

    public function delete(Request $request){
        $clubs = News::find($request->id);
        $clubs->delete();
        return redirect()->back();

        
    }
}
