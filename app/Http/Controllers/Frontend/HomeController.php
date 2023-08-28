<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coordinate;
use App\Models\Education;
use App\Models\Galerie;
use App\Models\Map;
use App\Models\Post;
use App\Models\Region;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->getClientIp();
        visit_new($ip);
        $category = category('world');
        $posts = Post::where('categorie_id', $category->id)->skip(0)->take(10)->orderBy('id', 'desc')->get();
        $galeries = Galerie::orderBy('id', 'desc')->get();
        $visibility = visibility('Breaking');
        $regions = Region::where('name', 'Desa Kalpataru')->get();
        $maps = Map::all();
        $educations = Education::all();
        $coordinates = Coordinate::all();
        return view('frontend.home.index', compact('posts', 'galeries', 'visibility', 'regions', 'maps', 'coordinates', 'educations'));
    }
}
