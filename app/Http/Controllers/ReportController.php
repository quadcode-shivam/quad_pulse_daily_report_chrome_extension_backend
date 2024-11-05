<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task_description' => 'required|string',
            'hours_worked' => 'required|numeric|min:0|max:24',
            'issues' => 'nullable|string',
        ]);
    
        Report::create($validatedData);
    
        return response()->json(['message' => 'Report submitted successfully'], 200);
    }
    // Retrieve all reports
    public function index()
    {
        // Fetch all reports from the database
        $reports = Report::all();

        // Return the reports as a JSON response
        return response()->json($reports, 200);
    }

    // Delete a report by its ID
    public function destroy($id)
    {
        // Find the report by ID and delete it
        $report = Report::findOrFail($id);
        $report->delete();

        // Return a success message
        return response()->json(['message' => 'Report deleted successfully'], 200);
    }
}
