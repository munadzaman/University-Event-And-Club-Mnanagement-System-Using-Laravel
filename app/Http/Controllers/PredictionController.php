<?php
// app/Http/Controllers/PredictionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventCategoryPredictionService;

class PredictionController extends Controller
{
    public function predictCategory(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        // Retrieve title and description from the form
        $title = $request->input('title');
        $description = $request->input('description');

        // Call the service to predict category
        $predictedCategory = EventCategoryPredictionService::predict($title, $description);

        // Redirect back to the form with the predicted category
        return back()->with('predictedCategory', $predictedCategory);
    }
}
