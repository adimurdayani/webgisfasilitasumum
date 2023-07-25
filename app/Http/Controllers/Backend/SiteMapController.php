<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Post;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        $categories = Categorie::orderBy('id', 'desc')->get();
        return response()->view('backend.sitemap.index', ['posts' => $posts, 'categories' => $categories])->header('Content-Type', 'text/xml');
    }
}
