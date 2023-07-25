<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        Gate::authorize('app.profile.index');
        $config_web = GeneralSetting::where('id', 1)->first();
        return view('backend.profile.index', compact('config_web'));
    }

    public function edit(Request $request, User $user)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email|string|max:255'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        Session::flash('success', 'Data berhasil disipman');
        return redirect()->back();
    }

    public function edit_password(Request $request, User $user)
    {
        $this->validate($request, [
            'password' => 'required|min:6|string|max:255',
            'konf_password' => 'required|min:6|same:password|string|max:255'
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);
        Auth::logout();
        return Redirect::to('/');
    }

    public function upload_foto(Request $request, User $user)
    {
        $img_user = File::where('folder', $request->img_user)->first();

        if ($img_user) {
            Storage::copy('public/img/tmp/' . $img_user->folder . '/' . $img_user->file, 'public/img/' . $img_user->folder . '/' . $img_user->file);
            Storage::delete('public/img/' . $user->img_user);

            $user->update([
                'img_user' => $img_user->folder . '/' . $img_user->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $img_user->folder);
            $img_user->delete();

            Session::flash('success', 'Profile saved successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Image not found!');
            return redirect()->back();
        }
    }

    public function tmpupload_img(Request $request)
    {
        if ($request->hasFile('img_user')) {
            $img_user = $request->file('img_user');
            $file_img_user = $img_user->getClientOriginalName();

            $folder = uniqid('user', true);
            $img_user->storeAs('public/img/tmp/' . $folder, $file_img_user);

            File::create([
                'folder' => $folder,
                'file' => $file_img_user,
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
