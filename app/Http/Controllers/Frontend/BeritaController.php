<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->getClientIp();
        visit_new($ip);
        return view(
            'frontend.berita.index',
            [
                'posts' => Post::where('type', 'article')->filter(request(['search', 'category']))->orderBy('id', 'desc')->paginate(3)
            ]
        );
    }
    public function detail_berita($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('frontend.berita.detail-berita', compact('post'));
    }
    public function addView(Request $request)
    {
        $post = Post::where('id', $request->id)->first();
        if ($request->ajax()) {
            $post->update([
                'views' => $post->views + 1
            ]);
        }
        return response()->json(['error' => 'Slug not found!.']);
    }
}
