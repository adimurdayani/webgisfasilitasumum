<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\File;
use App\Models\Post;
use App\Models\SubCategorie;
use App\Models\Visibilitie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function index()
    {
        Gate::authorize('app.posts.index');
        return view('backend.post.index');
    }

    public function load_data()
    {
        $posts = Post::with(['user', 'visibilities'])->orderBy('id', 'desc')->get();
        return DataTables::of($posts)
            ->editColumn('title_image', function ($post) {
                if ($post->image == null) {
                    return '<a href="/" class="text-body">
                    <img src="' . asset('assets/images/not_found.jpg') . '" class="img-thumbnail avatar-xl" title="' . $post->slug . '" >' . Str::limit($post->title, 20) . '</a>';
                } else {
                    return '<a href="/home/news/' . $post->slug . '/detail" class="text-body">
                    <img src="' . asset('storage/public/img') . '/' . $post->image . '" class="img-thumbnail avatar-xl" title="' . $post->slug . '" >' . Str::limit($post->title, 20) . '</a>';
                }
            })
            ->escapeColumns([])
            ->editColumn('publish', function ($post) {
                if ($post->publish == "Publish") {
                    # code...
                    return '<div class="badge badge-primary">Published</div>';
                } else {
                    return '<div class="badge badge-warning">Draf</div>';
                }
            })
            ->escapeColumns([])
            ->addColumn('category', function ($post) {
                return $post->category->title;
            })
            ->addColumn('user_name', function ($post) {
                return $post->user->name;
            })
            ->addColumn('visibility', function ($post) {
                return $post;
            })
            ->addColumn('created_at', function ($post) {
                return Carbon::parse($post->created_at)->locale('id')
                    ->settings(['formatFunction' => 'translatedFormat'])
                    ->format('l, j F Y');
            })
            ->addColumn('button', function ($post) {
                if ($post->type == 'Video') {
                    return '<div class="btn-group"> 
                    <button type="button" class="btn btn-sm btn-blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Other <i class="mdi mdi-chevron-down"></i> </button>
                        <div class="dropdown-menu">
                        <a href="/app/post/' . $post->id . '/video-edit" class="dropdown-item"><i class="fe-edit"></i> Edit</a>
                        <button type="button" class="dropdown-item hapus-data" data-id="' . $post->id . '"><i class="mdi mdi-trash-can"></i> Delete</button>
                    </div>
                </div>';
                } else {
                    return '<div class="btn-group"> 
                    <button type="button" class="btn btn-sm btn-blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Other <i class="mdi mdi-chevron-down"></i> </button>
                        <div class="dropdown-menu">
                        <a href="/app/post/' . $post->id . '/article-edit" class="dropdown-item"><i class="fe-edit"></i> Edit</a>
                        <button type="button" class="dropdown-item hapus-data" data-id="' . $post->id . '"><i class="mdi mdi-trash-can"></i> Delete</button>
                    </div>
                </div>';
                }
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function create()
    {
        Gate::authorize('app.posts.create');
        $categories = Categorie::all();
        $visibility = Visibilitie::all();
        return view('backend.post.add-post', compact('categories', 'visibility'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categorie_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_description' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_keywords' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_tag' => 'required|string|max:255',
        ]);

        $tmpfile_img = File::where('folder', $request->image)->first();
        if ($tmpfile_img) {
            Storage::copy('public/img/tmp/' . $tmpfile_img->folder . '/' . $tmpfile_img->file, 'public/img/' . $tmpfile_img->folder . '/' . $tmpfile_img->file);

            $post = Post::create([
                'categorie_id' => $request->categorie_id,
                'subcategorie_id' => $request->subcategorie_id,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'image' => $tmpfile_img->folder . '/' . $tmpfile_img->file,
                'image_description' => $request->image_description,
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'meta_tag' => $request->meta_tag,
                'publish' => $request->publish,
                'type' => 'article',
                'is_active' => $request->is_active,
            ]);
            $post->visibilities()->sync((array)$request->input('visibilitie_id'));

            Storage::deleteDirectory('public/img/tmp/' . $tmpfile_img->folder);
            $tmpfile_img->delete();

            Session::flash('success', 'Post created successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Post failed to save!');
            return redirect()->back();
        }
    }

    public function edit(Post $post)
    {
        if (empty($post->id)) {
            Session::flash('error', 'ID post not found!');
            return back();
        } else {
            Gate::authorize('app.posts.edit');
            $categories = Categorie::all();
            $visibility = Visibilitie::all();
            return view('backend.post.edit-post', compact('post', 'visibility', 'categories'));
        }
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'categorie_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_description' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_keywords' => 'required|string|max:255',
            'meta_description' => 'required',
            'meta_tag' => 'required|string|max:255',
        ]);

        $tmpfile_img = File::where('folder', $request->image)->first();
        if ($tmpfile_img) {
            Storage::copy('public/img/tmp/' . $tmpfile_img->folder . '/' . $tmpfile_img->file, 'public/img/' . $tmpfile_img->folder . '/' . $tmpfile_img->file);
            Storage::delete('public/img/' . $post->image);

            $post->update([
                'categorie_id' => $request->categorie_id,
                'subcategorie_id' => $request->subcategorie_id,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'image' => $tmpfile_img->folder . '/' . $tmpfile_img->file,
                'image_description' => $request->image_description,
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'meta_tag' => $request->meta_tag,
                'publish' => $request->publish,
                'type' => 'article',
                'is_active' => $request->is_active,
            ]);
            $post->visibilities()->sync((array)$request->input('visibilitie_id'));

            Storage::deleteDirectory('public/img/tmp/' . $tmpfile_img->folder);
            $tmpfile_img->delete();

            Session::flash('success', 'Post changed successfully!');
            return redirect()->back();
        } else {
            $post->update([
                'categorie_id' => $request->categorie_id,
                'subcategorie_id' => $request->subcategorie_id,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'image_description' => $request->image_description,
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'meta_tag' => $request->meta_tag,
                'publish' => $request->publish,
                'type' => 'article',
                'is_active' => $request->is_active,
            ]);
            $post->visibilities()->sync((array)$request->input('visibilitie_id'));
            Session::flash('success', 'Post changed successfully!');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Post::where('id', $request->id)->delete();
            return response()->json(['success' => 'Post deleted successfully!']);
        }
        return response()->json(['error' => 'Post not found!']);
    }

    public function sub_category(Request $request)
    {
        if ($request->ajax()) {
            $sub_categories = SubCategorie::where('id_category', $request->id)->get();
            return response()->json($sub_categories);
        }
        return response()->json(['error' => 'Sub category not found!']);
    }

    public function tmpupload_img(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_image = $image->getClientOriginalName();

            $folder = uniqid('post', true);
            $image->storeAs('public/img/tmp/' . $folder, $file_image);

            File::create([
                'folder' => $folder,
                'file' => $file_image,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Image not found!']);
    }

    public function tmpdelete_img()
    {
        $tmp_file = File::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('public/img/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Image not found!']);
    }
}
