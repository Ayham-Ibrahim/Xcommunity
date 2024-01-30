<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadFileTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\PodcastListRequest;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\PodcastListResource;
use App\Models\PodcastList;
use Illuminate\Support\Facades\Auth;

class PodcastListController extends Controller
{
    use ApiResponseTrait,UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $podcastLists = PodcastList::all();
        return $this->customeResponse(PodcastListResource::collection($podcastLists),'Done',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PodcastListRequest $request)
    {
        $Validation = $request->validated();

        if(!empty($request->image)){
            $path = $this->UploadFile($request,'podcastLists','image','photos');
        }else{
            $path = null;
        }

        $podcastList = PodcastList::create([
            'title'             =>$request->title,
            'description'       =>$request->decsription,
            'image'             => $path,
            "child_category_id" =>$request->child_category_id,
        ]);

        return $this->customeResponse(new PodcastListResource($podcastList),'podcastList created successfully',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PodcastList $podcastList)
    {
        if($podcastList){
            $user = Auth::user();
            $podcastList->visit($user);
            return $this->customeResponse(new PodcastListResource($podcastList),'Done',200);
        }else{
            return $this->customeResponse(null,'podcastList not found',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PodcastListRequest $request, PodcastList $podcastList)
    {
        if($podcastList){
            if(!empty($request->image)){
                $path = $this->UploadFile($request,'podcastLists','image','photos');
            }else{
                $path = $podcastList->image;
            }
            $podcastList->update([
                'title'             =>$request->title,
                'description'       =>$request->decsription,
                'image'             => $path,
                "child_category_id" =>$request->child_category_id,
            ]);
            return $this->customeResponse(new PodcastListResource($podcastList), "podcastList Updated Successfuly", 200);
        }else{
            return $this->customeResponse(null,'podcastList not found',404);
        };

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PodcastList $podcastList)
    {
        if($podcastList){
            $podcastList->delete();
            return $this->customeResponse("",'podcastList deleted successfully',200);
        }else{
            return $this->customeResponse(null,'podcastList not found',404);
        }
    }

    public function podcastListRating (RatingRequest $request , PodcastList $podcastList)
    {
        if(!empty($podcastList)){
            $rate = $request->rate;
            $podcastList->rateOnce($rate);
            $data = new PodcastListResource($podcastList);
            return $this->customeResponse($data, 'Done!', 200);
        }
        return $this->customeResponse(null,'not found',404);
    }
}
