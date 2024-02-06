<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\BookResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Models\UserInterest;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\DownloadFileTrait;
use App\Models\User;

class BookController extends Controller
{
    use ApiResponseTrait,UploadFileTrait;
    use DownloadFileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::all();
        return $this->customeResponse(BookResource::collection($books),'Done',200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $Validation = $request->validated();
        if(!empty($request->image)){
            $image_path = $this->UploadFile($request,'books','image','images');
        }else{
            $image_path = null;
        }

        $file_path = $this->UploadFile($request,'books','file','files');

        $book = Book::create([
            'title'           => $request->title,
            'image'           => $image_path,
            'file'            => $file_path,
            'description'     => $request->description,
            "category_id"     => $request->category_id,
            "section_id"      => 4,
        ]);
        return $this->customeResponse(new BookResource($book),'book created successfully',200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if($book){
            $user = Auth::user();
            $book->visit($user);
            return $this->customeResponse(new BookResource($book),'Done',200);
        }else{
            return $this->customeResponse(null,'book not found',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        if($book){
            if(!empty($request->image)){
                $image_path = $this->UploadFile($request,'books','image','images');
            }else{
                $image_path = $book->image;
            }
            if(!empty($request->image)){
                $file_path = $this->UploadFile($request,'books','file','files');
            }else{
                $file_path = $book->file;
            }

            $book->update([
                'title'           => $request->title,
                'image'           => $image_path,
                'file'            => $file_path,
                'description'     => $request->description,
                "category_id"     => $request->category_id,
                "section_id"      => $request->section_id,
            ]);
            return $this->customeResponse(new BookResource($book),'book created successfully',200);
        }else{
            return $this->customeResponse(null,'book not found',404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if($book){
            $book->delete();
            return $this->customeResponse(new BookResource($book),'Done',200);
        }else{
            return $this->customeResponse(null,'book not found',404);
        }
    }

    public function downloadFile(User $user,Book $book)
    {
        if($book){
            $user = Auth::user();
            return $this->downloadFile($user,$book->file, 'books');
        }else{
            return $this->customeResponse(null,'book not found',404);
        }

    }

    public function interstedBook()
    {
        $user_id = Auth::user()->id;
        $user_intesests = UserInterest::where('user_id',$user_id)->pluck('category_id')->toArray();
        $inerested_books = Book::where('category_id',$user_intesests)->get();

        return $this->customeResponse(BookResource::collection($inerested_books),'Done',200);

    }

    public function bookRating (RatingRequest $request , Book $book)
    {
        if(!empty($book)){
            $rate = $request->rate;
            $book->rateOnce($rate);
            $data = new BookResource($book);
            return $this->customeResponse($data, 'Done!', 200);
        }
        return $this->customeResponse(null,'not found',404);
    }
}
