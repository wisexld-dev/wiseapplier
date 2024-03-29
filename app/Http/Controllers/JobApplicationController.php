<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobApplications = JobApplication::all();

        return view('job_applications.index', compact('jobApplications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'job_description' => 'required|string'
        ]);

        $jobApplication = JobApplication::create($validatedData);

        return response()->json($jobApplication, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $jobApplication = JobApplication::findOrFail($id);

        // return view('job_applications.show', compact('jobApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        $jobApplication = JobApplication::findOrFail($id);
        
        // return view('job_applications.edit', compact('jobApplication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $validatedData = $request->validate([
            // pass
        ]);

        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->update($validatedData);

        
        // return redirect()->route('job_applications.index')->with('success', 'Job application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->delete();

        // return redirect()->route('job_applications.index')->with('success', 'Job application deleted successfully.');
    }
}
