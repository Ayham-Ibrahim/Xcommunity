<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadFileTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\PodcastListRequest;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\PodcastListResource;
use App\Models\ChildCategory;
use App\Models\PodcastList;
use App\Models\UserInterest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PodcastListController extends Controller
{
    use ApiResponseTrait, UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $podcastLists = PodcastList::all();
        return $this->customeResponse(PodcastListResource::collection($podcastLists), 'Done', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PodcastListRequest $request)
    {
        $Validation = $request->validated();

        if (!empty($request->image)) {
            $path = $this->UploadFile($request, 'podcastLists', 'image', 'photos');
        } else {
            $path = null;
        }

        $podcastList = PodcastList::create([
            'title'             => $request->title,
            'description'       => $request->decsription,
            'image'             => $path,
            "child_category_id" => $request->child_category_id,
        ]);

        return $this->customeResponse(new PodcastListResource($podcastList), 'podcastList created successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PodcastList $podcastList)
    {
        if ($podcastList) {
            $user = Auth::user();
            $podcastList->visit($user);
            return $this->customeResponse(new PodcastListResource($podcastList), 'Done', 200);
        } else {
            return $this->customeResponse(null, 'podcastList not found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PodcastListRequest $request, PodcastList $podcastList)
    {
        if ($podcastList) {
            if (!empty($request->image)) {
                $path = $this->UploadFile($request, 'podcastLists', 'image', 'photos');
            } else {
                $path = $podcastList->image;
            }
            $podcastList->update([
                'title'             => $request->title,
                'description'       => $request->decsription,
                'image'             => $path,
                "child_category_id" => $request->child_category_id,
            ]);
            return $this->customeResponse(new PodcastListResource($podcastList), "podcastList Updated Successfuly", 200);
        } else {
            return $this->customeResponse(null, 'podcastList not found', 404);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PodcastList $podcastList)
    {
        if ($podcastList) {
            $podcastList->delete();
            return $this->customeResponse("", 'podcastList deleted successfully', 200);
        } else {
            return $this->customeResponse(null, 'podcastList not found', 404);
        }
    }

    public function podcastListRating(RatingRequest $request, PodcastList $podcastList)
    {
        if (!empty($podcastList)) {

            $user = Auth::user();
            $rate = $request->rate;

            DB::beginTransaction();
            try {
                $podcastList->rateOnce($rate);
                $data = new PodcastListResource($podcastList);
                activity()->causedBy($user)->log('You have rated a podcast list about ' . $podcastList->title);

                DB::commit();
                return $this->customeResponse($data, 'Done!', 200);
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
        }
        return $this->customeResponse(null, 'not found', 404);
    }


    public function followList(User $user, PodcastList $podcastList)
    {
        if ($podcastList) {
            $user = Auth::user();
            return $podcastList->followToggle($user);
        }
        return $this->customeResponse(null, 'podcastList not found', 404);
    }

    public function interstePodcastList()
    {
        $user_id = Auth::user()->id;
        $user_interest_ids  = UserInterest::where('user_id', $user_id)->pluck('category_id')->toArray();
        $child_category_ids = ChildCategory::where('category_id', $user_interest_ids)->pluck('id')->toArray();
        $interest_podcastList = PodcastList::where('child_category_id', $child_category_ids)->get();
        $data = PodcastListResource::collection($interest_podcastList);

        return $this->customeResponse($data, 'Done!', 200);
    }
}
