<?php

namespace App\Http\Controllers\API;

use App\Models\Podcast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PodcastRequest;
use App\Http\Resources\PodcastResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $podcasts = Podcast::all();
        return $this->customeResponse(PodcastResource::collection($podcasts),'Done',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PodcastRequest $request)
    {
        $Validation = $request->validated();

        $voice_path = $this->UploadFile($request,'podcast','voice','files');
        $text_file_path = $this->UploadFile($request,'voice_text','text','files');

        $podcast = Podcast::create([
            'title'             =>$request->title,
            'voice'             => $voice_path,
            "child_category_id" =>$request->child_category_id,
            "duration"          => $request->duration,
            "text_file"         => $text_file_path,
            "podcast_list_id"   => $request->podcast_list_id,
            "section_id"        => 2,
        ]);

        return $this->customeResponse(new PodcastResource($podcast),'podcast created successfully',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Podcast $podcast)
    {
        if($podcast){
            $user = Auth::user();
            $podcast->visit($user);
            return $this->customeResponse(new PodcastResource($podcast),'Done',200);
        }else{
            return $this->customeResponse(null,'podcast not found',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PodcastRequest $request,Podcast $podcast)
    {
        if($podcast){

            if(!empty($request->voice)){
                $voice_path = $this->UploadFile($request,'podcast','voice','files');
            }else{
                $voice_path = $podcast->voice;
            }
            if(!empty($request->text_file)){
                $text_file_path = $this->UploadFile($request,'voice_text','text','files');
            }else{
                $text_file_path = $podcast->text_file;
            }

            $podcast->update([
                'title'             =>$request->title,
                'voice'             => $voice_path,
                "child_category_id" =>$request->child_category_id,
                "duration"          => $request->duration,
                "text_file"         => $text_file_path,
                "podcast_list_id"   => $request->podcast_list_id,
                "section_id"        => $request->section_id,
            ]);

            return $this->customeResponse(new PodcastResource($podcast),'podcast updated successfully',200);
        }else{
            return $this->customeResponse(null,'podcast not found',404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        if($podcast){
            $podcast->delete();
            return $this->customeResponse("",'podcast deleted successfully',200);
        }else{
            return $this->customeResponse(null,'podcast not found',404);
        }
    }



    public function toggleLike(User $user, Podcast $podcast)
    {
        if($podcast){
            $user = Auth::user();
            $activity = activity()->causedBy($user)->log('You liked the podcast about '. $podcast->title);
            return $podcast->toggleLike($user);
        }
        return $this->customeResponse(null, "not found", 404);

    }

    public function savetoArchive(Podcast $podcast)
    {
        if (!empty($podcast)) {
            $user = Auth::user();
            return $podcast->saveToArvhive($user);
        }
        return $this->customeResponse(null, "not found", 404);
    }
}
