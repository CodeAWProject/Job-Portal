<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{
    public function index()
    {
        return view('my_job_application.index',
        [
            //When you call the relationship method on a model, you get those job applications
            //scoped to that very user
            'applications' => auth()->user()->jobApplications()
                ->with([
                        //Getting all job applications of this specific job
                        'job' => fn($query) => $query->withCount('jobApplications')
                            ->withAvg('jobApplications', 'expected_salary'),
                        'job.employer'
                    ])
                ->latest()->get()
        ]
    );
    }

    public function destroy(string $id)
    {
        //
    }
}
