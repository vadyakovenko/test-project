<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UnsplashController
{
    public function search(Request $request)
    {
        $query = $request->input('query', ''); // Get the search query
        $page = $request->input('page', 1);    // Get the page number

        $response = Http::get('https://api.unsplash.com/search/photos', [
            'query' => $query,
            'page' => $page,
            'per_page' => 1, // Return 1 image per page
            'client_id' => env('UNSPLASH_ACCESS_KEY'),
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data from Unsplash'], 500);
        }

        return $response->json();
    }
}
