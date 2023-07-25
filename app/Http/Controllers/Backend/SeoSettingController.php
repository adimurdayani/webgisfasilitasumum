<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SeoSettingController extends Controller
{
    public function index()
    {
        Gate::authorize('app.seo-setting.index');
        $seo_setting = GeneralSetting::where('id', '1')->first();
        if (empty($seo_setting)) {
            return view('errors', [
                'code' => 404,
                'message' => 'Page not found!'
            ], 404);
        } else {
            return view('backend.seo-settings.index', compact('seo_setting'));
        }
    }

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            GeneralSetting::where('id', $request->pk)->update([
                $request->name => $request->value
            ]);

            return response()->json(['success' => 'Data berharsil disimpan!']);
        }
        return response()->json(['error' => 'Data tidak ditemukan!']);
    }

    public function update(Request $request, GeneralSetting $generalSetting)
    {
        $this->validate($request, [
            'goggle_analytics_id' => 'required'
        ]);

        $generalSetting->update([
            'goggle_analytics_id' => $request->goggle_analytics_id,
            'costum_js' => $request->costum_js,
            'addthis_script' => $request->addthis_script,
            'addthis_toolbox_code' => $request->addthis_toolbox_code,
        ]);
        Session::flash('succcess', 'Data berhasil disimpan!');
        return redirect()->back();
    }

    public function upload_og_img(Request $request, GeneralSetting $generalSetting)
    {
        $og_img = File::where('folder', $request->og_img)->first();

        if ($og_img) {
            Storage::copy('public/img/tmp/' . $og_img->folder . '/' . $og_img->file, 'public/img/' . $og_img->folder . '/' . $og_img->file);
            Storage::delete('public/img/' . $generalSetting->og_img);

            $generalSetting->update([
                'og_img' => $og_img->folder . '/' . $og_img->file,
            ]);

            Storage::deleteDirectory('public/img/tmp/' . $og_img->folder);
            $og_img->delete();

            Session::flash('success', 'Data berhasil disimpan!');
            return redirect()->back();
        } else {
            Session::flash('error', 'Tidak ada gambar yang diupload!');
            return redirect()->back();
        }
    }

    public function tmpog_img(Request $request)
    {
        if ($request->hasFile('og_img')) {
            $og_img = $request->file('og_img');
            $file_og_img = $og_img->getClientOriginalName();

            $folder = uniqid('ogimg', true);
            $og_img->storeAs('public/img/tmp/' . $folder, $file_og_img);

            File::create([
                'folder' => $folder,
                'file' => $file_og_img,
            ]);
            return $folder;
        }

        return response()->json(['error' => 'Image not found!']);
    }

    public function tmpdelete_ogimg()
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
