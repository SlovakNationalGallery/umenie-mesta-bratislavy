<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Location;

class HomeController extends Controller
{
    public function index()
    {
        $locations = Location::select(DB::raw('count(id) as count'), 'borough')
            ->where('is_current', true)
            ->groupBy('borough')
            ->get()
            ->groupBy('district');

        return view('welcome')->with(compact(['locations']));
    }
}
