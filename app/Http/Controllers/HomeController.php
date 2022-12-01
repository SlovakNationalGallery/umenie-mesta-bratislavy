<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Location;


class HomeController extends Controller
{
    public function index()
    {
        $locations = DB::table('artworks')
            ->join('artwork_location', 'artwork_location.artwork_id', '=', 'artworks.id')
            ->join('locations', 'artwork_location.location_id', "=", 'locations.id')
            ->select('borough', 'district' , DB::raw('count(*) as total'))
            ->groupBy('borough', 'district')
            ->get();

        return view('welcome')->with(
            compact(['locations'])
        );

    }
}
