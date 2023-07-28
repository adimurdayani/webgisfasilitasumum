<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\File;
use App\Models\Post;
use App\Models\Visibilitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostVideoController extends Controller
{
    public function create()
    {
        Gate::authorize('app.posts.create-video');
        $categories = Categorie::all();
        $visibility = Visibilitie::all();
        $publises = Post::getValueData('publish');
        return view('backend.post.add-post-video', compact('categories', 'visibility', 'publises'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categorie_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_description' => 'required',
            'meta_title' => 'required|string|max:255',
            'meta_keywords' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_tag' => 'required|string|max:255',
        ]);

        $tmpfile_img = File::where('folder', $request->image)->first();
        $tmpfile_thumb = File::where('folder', $request->img_thumb_video)->first();
        if ($tmpfile_img && $tmpfile_thumb) {
            Storage::copy('public/img/tmp/' . $tmpfile_img->folder . '/' . $tmpfile_img->file, 'public/img/' . $tmpfile_img->folder . '/' . $tmpfile_img->file);

            Storage::copy('public/img/tmp/' . $tmpfile_thumb->folder . '/' . $tmpfile_thumb->file, 'public/img/' . $tmpfile_thumb->folder . '/' . $tmpfile_thumb->file);

            $post = Post::create([
                'categorie_id' => $request->id_categories,
                'subcategorie_id' => $request->id_subcategories,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'image' => $tmpfile_img->folder . '/' . $tmpfile_img->file,
                'image_description' => $request->image_description,
                'img_thumb_video' => $tmpfile_img->folder . '/' . $tmpfile_img->file,
                'url_video' => $request->url_video,
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'meta_tag' => $request->meta_tag,
                'publish' => $request->publish,
                'type' => 'video',
                'is_active' => $request->is_active,
            ]);
            $post->visibilities()->sync((array)$request->input('visibilitie_id'));

            Storage::deleteDirectory('public/img/tmp/' . $tmpfile_img->folder);
            $tmpfile_img->delete();

            Storage::deleteDirectory('public/img/tmp/' . $tmpfile_thumb->folder);
            $tmpfile_thumb->delete();

            Session::flash('success', 'Post video created successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Post video failed to save!');
            return redirect()->back();
        }
    }

    public function edit(Post $post)
    {
        if (empty($post->id)) {
            Session::flash('error', 'Post not found!');
            return back();
        } else {
            Gate::authorize('app.posts.edit-video');
            $categories = Categorie::all();
            $visibility = Visibilitie::all();
            $publises = Post::getValueData('publish');
            return view('backend.post.edit-post-video', compact('categories', 'visibility', 'post', 'publises'));
        }
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'categorie_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_description' => 'required',
            'meta_title' => 'required|string|max:255',
            'meta_keywords' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_tag' => 'required|string|max:255',
        ]);

        $tmpfile_img = File::where('folder', $request->image)->first();
        $tmpfile_thumb = File::where('folder', $request->img_thumb_video)->first();
        if ($tmpfile_img && $tmpfile_thumb) {
            Storage::copy('public/img/tmp/' . $tmpfile_img->folder . '/' . $tmpfile_img->file, 'public/img/' . $tmpfile_img->folder . '/' . $tmpfile_img->file);
            Storage::delete('public/img/' . $post->image);

            Storage::copy('public/img/tmp/' . $tmpfile_thumb->folder . '/' . $tmpfile_thumb->file, 'public/img/' . $tmpfile_thumb->folder . '/' . $tmpfile_thumb->file);
            Storage::delete('public/img/' . $post->img_thumb_video);

            $post->update([
                'categorie_id' => $request->id_categories,
                'subcategorie_id' => $request->id_subcategories,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'image' => $tmpfile_img->folder . '/' . $tmpfile_img->file,
                'image_description' => $request->image_description,
                'img_thumb_video' => $tmpfile_img->folder . '/' . $tmpfile_img->file,
                'url_video' => $request->url_video,
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'meta_tag' => $request->meta_tag,
                'publish' => $request->publish,
                'type' => 'video',
                'is_active' => $request->is_active,
            ]);
            $post->visibilities()->sync((array)$request->input('visibilitie_id'));

            Storage::deleteDirectory('public/img/tmp/' . $tmpfile_img->folder);
            $tmpfile_img->delete();

            Storage::deleteDirectory('public/img/tmp/' . $tmpfile_thumb->folder);
            $tmpfile_thumb->delete();

            Session::flash('success', 'Post video changed successfully!');
            return redirect()->back();
        } else {
            $post->update([
                'categorie_id' => $request->id_categories,
                'subcategorie_id' => $request->id_subcategories,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'image_description' => $request->image_description,
                'url_video' => $request->url_video,
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'meta_tag' => $request->meta_tag,
                'publish' => $request->publish,
                'type' => 'video',
                'is_active' => $request->is_active,
            ]);
            $post->visibilities()->sync((array)$request->input('visibilitie_id'));
            Session::flash('success', 'Post video changed successfully!');
            return redirect()->back();
        }
    }

    public function tmpupload_thumb(Request $request)
    {
        if ($request->hasFile('img_thumb_video')) {
            $img_thumb_video = $request->file('img_thumb_video');
            $file_img_thumb_video = $img_thumb_video->getClientOriginalName();

            $folder = uniqid('post', true);
            $img_thumb_video->storeAs('public/img/tmp/' . $folder, $file_img_thumb_video);

            File::create([
                'folder' => $folder,
                'file' => $file_img_thumb_video,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Image not found!']);
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
