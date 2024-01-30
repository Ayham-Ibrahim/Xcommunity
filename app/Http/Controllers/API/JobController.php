<?php

namespace App\Http\Controllers\API;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();
        return $this->customeResponse(JobResource::collection($jobs),'Done',200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $Validation = $request->validated();
        if(!empty($request->image)){
            $path = $this->UploadFile($request,'jobs','image','photos');
        }else{
            $path = null;
        }
        $job = Job::create([
            'title'           => $request->title,
            'image'           => $path,
            'description'     => $request->description,
            "tasks"           => $request->tasks,
            "skills"          => $request->skills,
            "age"             => $request->age,
            "job_type"        => $request->job_type,
            "email"           => $request->email,
            "nationality"     => $request->nationality,
            "gender"          => $request->gender,
            "section_id"      => $request->section_id,
        ]);
        return $this->customeResponse(new JobResource($job),'job created successfully',200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        if($job){
            return $this->customeResponse(new JobResource($job),'Done',200);
        }else{
            return $this->customeResponse(null,'job not found',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        if($job){
            if(!empty($request->image)){
                $path = $this->UploadFile($request,'jobs','image','photos');
            }else{
                $path = $job->image;
            }
            $job->update([
                'title'           => $request->title,
                'description'     => $path,
                "tasks"           => $request->tasks,
                "skills"          => $request->skills,
                "age"             => $request->age,
                "job_type"        => $request->job_type,
                "email"           => $request->email,
                "nationality"     => $request->nationality,
                "gender"          => $request->gender,
                "section_id"      => $request->section_id,
            ]);

            return $this->customeResponse(new JobResource($job),'job updated successfully',200);
        }else{
            return $this->customeResponse(null,'job not found',404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        if($job){
            $job->delete();
            return $this->customeResponse(new JobResource($job),'Done',200);
        }else{
            return $this->customeResponse(null,'job not found',404);
        }
    }
}
