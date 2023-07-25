<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GeneralSettingController extends Controller
{
    public function index()
    {
        Gate::authorize('app.settings.index');
        $generalSetting = GeneralSetting::where('id', 1)->first();
        if (empty($generalSetting)) {
            return view('errors', [
                'code' => 404,
                'message' => 'Page not found!'
            ], 404);
        } else {
            return view('backend.settings.index', compact('generalSetting'));
        }
    }

    public function company_setting()
    {
        Gate::authorize('app.settings.company-setting');
        $generalSetting = GeneralSetting::where('id', 1)->first();
        return view('backend.settings.company-settings', compact('generalSetting'));
    }

    public function social_setting()
    {
        Gate::authorize('app.settings.social-setting');
        $generalSetting = GeneralSetting::where('id', 1)->first();
        if (empty($generalSetting)) {
            return view('errors', [
                'code' => 404,
                'message' => 'Page not found!'
            ], 404);
        } else {
            return view('backend.settings.social-setting', compact('generalSetting'));
        }
    }

    public function recaptcha_setting()
    {
        Gate::authorize('app.settings.recaptcha-setting');
        $generalSetting = GeneralSetting::where('id', 1)->first();
        if (empty($generalSetting)) {
            return view('errors', [
                'code' => 404,
                'message' => 'Page not found!'
            ], 404);
        } else {
            return view('backend.settings.recaptcha-settings', compact('generalSetting'));
        }
    }

    public function update_status_recaptcha(Request $request, GeneralSetting $generalSetting)
    {

        $generalSetting->update([
            'captcha_is_active' => $request->captcha_is_active
        ]);

        Session::flash('success', 'Status reCaptcha changed successfully');
        return back();
    }

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            GeneralSetting::where('id', $request->pk)->update([
                $request->name => $request->value
            ]);

            return response()->json(['success' => 'Setting changed successfully!']);
        }
        return response()->json(['error' => 'Data not found!']);
    }

    // img user
    public function upload_img_user(Request $request, GeneralSetting $generalSetting)
    {
        $img_user = File::where('folder', $request->img_user)->first();

        if ($img_user) {
            Storage::copy('public/img/tmp/' . $img_user->folder . '/' . $img_user->file, 'public/img/' . $img_user->folder . '/' . $img_user->file);
            Storage::delete('public/img/' . $generalSetting->img_user);

            $generalSetting->update([
                'img_user' => $img_user->folder . '/' . $img_user->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $img_user->folder);
            $img_user->delete();

            Session::flash('success', 'Image saved successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Image not found!');
            return redirect()->back();
        }
    }

    public function tmpimg_user(Request $request)
    {
        if ($request->hasFile('img_user')) {
            $img_user = $request->file('img_user');
            $file_img_user = $img_user->getClientOriginalName();

            $folder = uniqid('post', true);
            $img_user->storeAs('public/img/tmp/' . $folder, $file_img_user);

            File::create([
                'folder' => $folder,
                'file' => $file_img_user,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Data not found!']);
    }

    public function tmpdelete_imguser()
    {
        $tmp_file = File::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('public/img/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Data not found!']);
    }

    // img favicon

    public function upload_img_fav(Request $request, GeneralSetting $generalSetting)
    {
        $img_fav = File::where('folder', $request->img_fav)->first();

        if ($img_fav) {
            Storage::copy('public/img/tmp/' . $img_fav->folder . '/' . $img_fav->file, 'public/img/' . $img_fav->folder . '/' . $img_fav->file);
            Storage::delete('public/img/' . $generalSetting->img_fav);

            $generalSetting->update([
                'img_fav' => $img_fav->folder . '/' . $img_fav->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $img_fav->folder);
            $img_fav->delete();

            Session::flash('success', 'Image saved successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Image not found!');
            return redirect()->back();
        }
    }

    public function tmpimg_fav(Request $request)
    {
        if ($request->hasFile('img_fav')) {
            $img_fav = $request->file('img_fav');
            $file_img_fav = $img_fav->getClientOriginalName();

            $folder = uniqid('post', true);
            $img_fav->storeAs('public/img/tmp/' . $folder, $file_img_fav);

            File::create([
                'folder' => $folder,
                'file' => $file_img_fav,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Data not found!']);
    }

    public function tmpdelete_imgfav()
    {
        $tmp_file = File::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('public/img/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Data not found!']);
    }

    // img sm

    public function upload_img_sm(Request $request, GeneralSetting $generalSetting)
    {
        $img_sm = File::where('folder', $request->img_sm)->first();

        if ($img_sm) {
            Storage::copy('public/img/tmp/' . $img_sm->folder . '/' . $img_sm->file, 'public/img/' . $img_sm->folder . '/' . $img_sm->file);
            Storage::delete('public/img/' . $generalSetting->img_sm);

            $generalSetting->update([
                'img_sm' => $img_sm->folder . '/' . $img_sm->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $img_sm->folder);
            $img_sm->delete();

            Session::flash('success', 'Image saved successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Image not found!');
            return redirect()->back();
        }
    }

    public function tmpimg_sm(Request $request)
    {
        if ($request->hasFile('img_sm')) {
            $img_sm = $request->file('img_sm');
            $file_img_sm = $img_sm->getClientOriginalName();

            $folder = uniqid('post', true);
            $img_sm->storeAs('public/img/tmp/' . $folder, $file_img_sm);

            File::create([
                'folder' => $folder,
                'file' => $file_img_sm,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Data not found!']);
    }

    public function tmpdelete_imgsm()
    {
        $tmp_file = File::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('public/img/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Data not found!']);
    }

    // img lg

    public function upload_img_lg(Request $request, GeneralSetting $generalSetting)
    {
        $img_lg = File::where('folder', $request->img_lg)->first();

        if ($img_lg) {
            Storage::copy('public/img/tmp/' . $img_lg->folder . '/' . $img_lg->file, 'public/img/' . $img_lg->folder . '/' . $img_lg->file);
            Storage::delete('public/img/' . $generalSetting->img_lg);

            $generalSetting->update([
                'img_lg' => $img_lg->folder . '/' . $img_lg->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $img_lg->folder);
            $img_lg->delete();

            Session::flash('success', 'Image saved successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Image not found!');
            return redirect()->back();
        }
    }

    public function tmpimg_lg(Request $request)
    {
        if ($request->hasFile('img_lg')) {
            $img_lg = $request->file('img_lg');
            $file_img_lg = $img_lg->getClientOriginalName();

            $folder = uniqid('post', true);
            $img_lg->storeAs('public/img/tmp/' . $folder, $file_img_lg);

            File::create([
                'folder' => $folder,
                'file' => $file_img_lg,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Data not found!']);
    }

    public function tmpdelete_imglg()
    {
        $tmp_file = File::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('public/img/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response()->json(['success' => true]);
        }
    }

    // img nota

    public function upload_img_nota(Request $request, GeneralSetting $generalSetting)
    {
        $img_nota = File::where('folder', $request->img_nota)->first();

        if ($img_nota) {
            Storage::copy('public/img/tmp/' . $img_nota->folder . '/' . $img_nota->file, 'public/img/' . $img_nota->folder . '/' . $img_nota->file);
            Storage::delete('public/img/' . $generalSetting->img_nota);

            $generalSetting->update([
                'img_nota' => $img_nota->folder . '/' . $img_nota->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $img_nota->folder);
            $img_nota->delete();

            Session::flash('success', 'Image saved successfully!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Image not found!');
            return redirect()->back();
        }
    }

    public function tmpimg_nota(Request $request)
    {
        if ($request->hasFile('img_nota')) {
            $img_nota = $request->file('img_nota');
            $file_img_nota = $img_nota->getClientOriginalName();

            $folder = uniqid('post', true);
            $img_nota->storeAs('public/img/tmp/' . $folder, $file_img_nota);

            File::create([
                'folder' => $folder,
                'file' => $file_img_nota,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Data not found!']);
    }

    public function tmpdelete_imgnota()
    {
        $tmp_file = File::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('public/img/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Data not found!']);
    }
}
