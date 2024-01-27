<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplementRequest;
use App\Http\Resources\SupplementResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\Supplement;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplementController extends Controller
{
    use ApiResponseTrait, UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplements = Supplement::all();
        $data = SupplementResource::collection($supplements);
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplementRequest $request)
    {
        $image_path = $this->UploadPhoto($request, 'supplements', 'image', 'images');
        $file_path = $this->UploadPhoto($request, 'supplements', 'file', 'files');

        $supplement = Supplement::create([
            'title'       => $request->title,
            'discription' => $request->discription,
            'image'       => $image_path,
            'file'        => $file_path,
            'category_id' => $request->category_id,
            'section_id'  => 4
        ]);

        $data = new SupplementResource($supplement);

        return $this->customeRespone($data, "Supplement Created Successfuly", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplement $supplement)
    {
        if(!empty($supplement)){
            $data = new SupplementResource($supplement);
            return $this->customeRespone($data, "Done!", 200);
        }
        return $this->customeRespone(null, "not found", 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplementRequest $request, Supplement $supplement)
    {
        if (!empty($supplement->image)) {
            $image_path = $this->UploadPhoto($request, 'supplements', 'image', 'images');
        } else {
            $image_path = $supplement->image;
        }

        if (!empty($supplement->file)) {
            $file_path = $this->UploadPhoto($request, 'supplements', 'file', 'files');
        } else {
            $file_path = $supplement->file;
        }

        $supplement->update([
            'title'       => $request->title,
            'discription' => $request->discription,
            'image'       => $image_path,
            'file'        => $file_path,
        ]);

        $data = new SupplementResource($supplement);


        return $this->customeRespone($data, "Supplement Updated Successfuly", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplement $supplement)
    {
        if (!empty($supplement)) {
            $supplement->delete();
            return $this->customeRespone(null , "Supplement deleted Successfully" , 200);
        }

        return $this->customeRespone(null, "not found", 404);
    }

    public function intersteSupplements()
    {
        $user_id = Auth::user()->id;
        $user_interest_ids  = UserInterest::where('user_id', $user_id)->pluck('category_id')->toArray();
        $interest_supplements = Supplement::where('category_id', $user_interest_ids)->get();
        $data = SupplementResource::collection($interest_supplements);

        return $this->customeResponse($data, 'Done!', 200);
    }

    public function download(Supplement $supplement)
    {
        if (!empty($supplement)) {
            return $this->downloadFile($supplement->file, 'supplements');
        }else{
            return $this->customeResponse(null,'book not found',404);
        }

    }

}
