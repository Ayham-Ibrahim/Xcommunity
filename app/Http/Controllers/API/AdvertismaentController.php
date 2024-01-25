<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertismaentRequest;
use App\Http\Resources\AdvertismaentResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\Advertismaent;
use App\Models\Article;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertismaentController extends Controller
{
    use ApiResponseTrait, UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertismaents = Advertismaent::all();
        $data = AdvertismaentResource::collection($advertismaents);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdvertismaentRequest $request)
    {
        $path = $this->UploadPhoto($request, 'advertismaents', 'image', 'images');

        $advertismaent = Article::create([
            'title' => $request->title,
            'discription' => $request->discription,
            'trainning_topics' => $request->trainning_topics,
            'details' => $request->details,
            'cost' => $request->cost,
            'trainning_outcomes' => $request->trainning_outcomes,
            'reservation' => $request->reservation,
            'image' => $path,
            'section_id' => 6
        ]);

        $data = new AdvertismaentResource($advertismaent);

        return $this->customeRespone($data, "Advertismaent Created Successfuly", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertismaent $advertismaent)
    {
        if(!empty($advertismaent)){
            $data = new AdvertismaentResource($advertismaent);
            return $this->customeRespone($data, "Done!", 200);
        }
        return $this->customeRespone(null, "not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertismaentRequest $request, Advertismaent $advertismaent)
    {
        if (!empty($request->image)) {

            $path = $this->UploadPhoto($request, 'advertismaents', 'image', 'images');
        } else {
            $path = $advertismaent->image;
        }

        $advertismaent->update([
            'title' => $request->title,
            'discription' => $request->discription,
            'trainning_topics' => $request->trainning_topics,
            'details' => $request->details,
            'cost' => $request->cost,
            'trainning_outcomes' => $request->trainning_outcomes,
            'reservation' => $request->reservation,
            'image' => $path
        ]);

        $data = new AdvertismaentResource($advertismaent);


        return $this->customeRespone($data, "Advertismaent Updated Successfuly", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertismaent $advertismaent)
    {
        if (!empty($advertismaent)) {
            $advertismaent->delete();
            return $this->customeRespone(null , "Advertismaent deleted successfully" , 200);
        }

        return $this->customeRespone(null, "not found", 404);
    }

}
