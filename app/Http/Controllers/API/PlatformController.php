<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlatformRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\GetNewsTrait;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimplePie\SimplePie;

class PlatformController extends Controller
{
    use ApiResponseTrait, GetNewsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::all();

        $i=0;
        foreach ($platforms as $platform) {

            $feedUrl = $platform->rss_feed;
            $data[$i] = $this->getNews($feedUrl);
            $i++;
        }
        return $this->customeResponse($data, 'Done!', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (PlatformRequest $request)
    {
        $feedUrl =  $request->rss_feed;

        $feed = new SimplePie();
        $feed->set_feed_url($feedUrl);
        $feed->enable_cache(false);
        $feed->init();
        if (empty($feed->get_items())) {
            return response()->json(['message' => 'This Link Is Invalid']);
        }

        DB::beginTransaction();
        try {
            $platform = Platform::create([
                'rss_feed' => $feedUrl
            ]);

            $user_id = Auth::user()->id;
            $user = User::find($user_id);
            $user->platforms()->attach($platform->id);

            DB::commit();
            return response()->json(['message' => 'Platform added successfully'], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Platform $platform)
    {
        if (!empty($platform)) {

            $feedUrl = $platform->rss_feed;

            $data = $this->getNews($feedUrl);

            return $this->customeResponse($data, 'Done!', 200);
        }
        return $this->customeResponse(null, "not found", 404);
    }
}
