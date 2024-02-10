<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\Store;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    use ApiResponseTrait, UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        $stores = Store::where('type', $type)->get();
        $data = StoreResource::collection($stores);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $image_path = $this->UploadPhoto($request, 'Stores', 'image', 'images');
        $file_path = $this->UploadPhoto($request, 'Stores', 'file', 'files');

        $store = Store::create([
            'title'       => $request->title,
            'discription' => $request->discription,
            'image'       => $image_path,
            'file'        => $file_path,
            'type'        => $request->type,
            'category_id' => $request->category_id,
            'section_id'  => 4
        ]);

        $data = new StoreResource($store);

        return $this->customeRespone($data, $store->type ." Created Successfuly", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        if(!empty($store)){
            $user = Auth::user();
            $store->visit($user);
            $data = new StoreResource($store);
            return $this->customeRespone($data, "Done!", 200);
        }
        return $this->customeRespone(null, "not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        if (!empty($store->image)) {
            $image_path = $this->UploadPhoto($request, 'stores', 'image', 'images');
        } else {
            $image_path = $store->image;
        }

        if (!empty($store->file)) {
            $file_path = $this->UploadPhoto($request, 'stores', 'file', 'files');
        } else {
            $file_path = $store->file;
        }

        $store->update([
            'title'       => $request->title,
            'discription' => $request->discription,
            'image'       => $image_path,
            'file'        => $file_path,
        ]);

        $data = new StoreResource($store);


        return $this->customeRespone($data, $store->type ." Updated Successfuly", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        if (!empty($store)) {
            $store->delete();
            return $this->customeRespone(null , $store->type ." deleted Successfully" , 200);
        }

        return $this->customeRespone(null, "not found", 404);
    }

    public function intersteStores($type)
    {
        $user_id = Auth::user()->id;
        $user_interest_ids  = UserInterest::where('user_id', $user_id)->pluck('category_id')->toArray();
        $interest_stores = Store::where('category_id', $user_interest_ids)->where('type', $type)->get();
        $data = StoreResource::collection($interest_stores);

        return $this->customeResponse($data, 'Done!', 200);
    }

    public function download(Store $store)
    {
        if (!empty($store)) {
            $user = Auth::user();
            $activity = activity()->causedBy($user)->log('You have downloaded a '. $store->type . ' about '. $store->title);
            return $this->downloadFile($store->file, 'stores');
        }else{
            return $this->customeResponse(null,'not found',404);
        }

    }

    public function storetRating (RatingRequest $request , Store $store)
    {
        if(!empty($store)){
            $user = Auth::user();
            $rate = $request->rate;
            $store->rateOnce($rate);
            $data = new StoreResource($store);
            $activity = activity()->causedBy($user)->log('You have rated a '. $store->type .' about'. $store->title);
            return $this->customeResponse($data, 'Done!', 200);
        }
        return $this->customeResponse(null,'not found',404);
    }

    public function saveToList(UserList $userList, Store $store)
    {
        if ($store) {
            if ($userList) {
                $user = Auth::user();
                return $store->saveToList($user, $userList);
            }
            return $this->customeResponse(null, "userlist  not found", 404);
        }
        return $this->customeResponse(null, "not found", 404);
    }

    public function savetoArchive(Store $store)
    {
        if (!empty($store)) {
            $user = Auth::user();
            $store->saveToArchive($user);
            return response()->json(['message' => $store->type .' Saved To Archive ']);
        }
        return $this->customeResponse(null, "not found", 404);
    }
}
