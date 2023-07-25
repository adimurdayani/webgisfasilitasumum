<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    public function index()
    {
        if (language(1)) {
            foreach (language(1) as $language) {
                App::setLocale($language->code);
            }
        } else {
            App::setLocale('en');
        }

        Gate::authorize('app.languages.index');

        $languages = Language::all();

        $columns = [];
        $columnCount =   $languages->count();

        if ($languages->count() > 0) {
            foreach ($languages as $key => $language) {
                if ($key == 0) {
                    $columns[$key] = $this->openJSONFile($language->code);
                }
                $columns[++$key] = ['data' => $this->openJSONFile($language->code), 'lang' => $language->code];
            }
        }

        return view('backend.settings.language', compact('languages', 'columns', 'columnCount'));
    }


    public function createLanguage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Error!']);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|string',
            'value' => 'required|string',
        ]);

        $data = $this->openJSONFile('en');
        $data[$request->key] = $request->value;
        $this->saveJSONFile('en', $data);

        Session::flash('success', 'Language added successfully!');
        return redirect()->back();
    }

    public function transUpdate(Request $request)
    {
        $data = $this->openJSONFile($request->code);
        $data[$request->pk] = $request->value;

        $this->saveJSONFile($request->code, $data);
        return response()->json(['success' => 'Done!']);
    }

    public function transUpdateKey(Request $request)
    {
        $languages = Language::get();


        if ($languages->count() > 0) {
            foreach ($languages as $language) {
                $data = $this->openJSONFile($language->code);
                if (isset($data[$request->pk])) {
                    $data[$request->value] = $data[$request->pk];
                    unset($data[$request->pk]);
                    $this->saveJSONFile($language->code, $data);
                }
            }
        }


        return response()->json(['success' => 'Done!']);
    }

    public function destroy($key)
    {
        $languages = Language::get();

        if ($languages->count() > 0) {
            foreach ($languages as $language) {
                $data = $this->openJSONFile($language->code);
                unset($data[$key]);
                $this->saveJSONFile($language->code, $data);
            }
        }
        return response()->json(['success' => $key]);
    }

    private function openJSONFile($code)
    {
        $jsonString = [];
        if (File::exists(base_path('resources/lang/' . $code . '.json'))) {
            $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }

    private function saveJSONFile($code, $data)
    {
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
    }
}
