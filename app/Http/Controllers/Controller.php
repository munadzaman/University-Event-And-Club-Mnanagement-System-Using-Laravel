<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, ValidatesRequests;

    public function predictEventCategory(Request $request)
    {
        // Get the event description from the request
        $eventDescription = $request->input('description');

        // Call the Python script with the event description as input
        $pythonScriptPath = base_path('app/Services/event_category_prediction.py');
        $command = "python $pythonScriptPath \"$eventDescription\"";
        
        // Execute the command
        $predictedCategory = exec($command);

        // Return the predicted category
        return response()->json(['predicted_category' => $predictedCategory]);
    }
}
