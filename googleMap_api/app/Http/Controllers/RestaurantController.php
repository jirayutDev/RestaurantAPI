<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index($keyword)
    {
        $client = new Client([
            'verify' => false
        ]);
        $response = $client->get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
            'query' => [
                'query' => $keyword . ' restaurants',
                'key' => env('GOOGLE_MAPS_API_KEY'),
            ],
        ]);

        return $response->getBody();
    }
}
