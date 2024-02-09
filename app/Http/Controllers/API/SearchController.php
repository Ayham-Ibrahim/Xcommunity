<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertismaentResource;
use App\Http\Resources\ArticleGroupResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\JobResource;
use App\Http\Resources\PodcastListResource;
use App\Http\Resources\PodcastResource;
use App\Http\Resources\SupplementResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Advertismaent;
use App\Models\Article;
use App\Models\ArticleGroup;
use App\Models\Book;
use App\Models\Job;
use App\Models\Podcast;
use App\Models\PodcastList;
use App\Models\Supplement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    use ApiResponseTrait;

    public function search ($search_param)
    {
        // Get All Query
        $advertismaent_query = Advertismaent::search($search_param)->get();
        $article_query       = Article::search($search_param)->get();
        $article_groub_query = ArticleGroup::search($search_param)->get();
        $book_query          = Book::search($search_param)->get();
        $job_query           = Job::search($search_param)->get();
        $podcast_query       = Podcast::search($search_param)->get();
        $podcast_list_query  = PodcastList::search($search_param)->get();
        $supplement_query    = Supplement::search($search_param)->get();
        ////////////////

        $data['Advertismaent :'] = AdvertismaentResource::collection($advertismaent_query);
        $data['Article :']       = ArticleResource::collection($article_query);
        $data['ArticleGroup :']  = ArticleGroupResource::collection($article_groub_query);
        $data['Book :']          = BookResource::collection($book_query);
        $data['Job :']           = JobResource::collection($job_query);
        $data['Podcast :']       = PodcastResource::collection($podcast_query);
        $data['PodcastList :']   = PodcastListResource::collection($podcast_list_query);
        $data['Supplement :']    = SupplementResource::collection($supplement_query);

        $user = Auth::user();
        $activity = activity()->causedBy($user)->log('You have searched about '. $search_param);

        return $this->customeResponse($data , 'Done', 200);
    }
}
