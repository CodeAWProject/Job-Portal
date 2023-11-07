<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', Job::class);
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience', 
            'category'
        );

        
        //Loading all the jobs, getting an employer for every single job and applying the filter
        return view(
            'job.index',
            ['jobs' => Job::with('employer')->latest()->filter($filters)->get()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {

        $this->authorize('view', $job);
        return view(
            'job.show', 
            ['job' => $job->load('employer.jobs')]);
    }


}
