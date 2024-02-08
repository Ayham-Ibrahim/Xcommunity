<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlatformRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\GetNewsTrait;
use App\Models\Platform;
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

        $platform = Platform::create([
            'rss_feed' => $request->rss_feed
        ]);

        return response()->json(['message' => 'Platform added successfully'], 201);
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
