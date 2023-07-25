<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $tag = Tag::create([
                'name' => $request->name
            ]);
            return response()->json($tag);
        }
        return response()->json(['error' => 'Tag not found!']);
    }
}
