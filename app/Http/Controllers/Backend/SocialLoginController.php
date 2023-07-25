<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SocialLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class SocialLoginController extends Controller
{
    public function index()
    {
        Gate::authorize('app.settings.social-login-setting');
        return view('backend.settings.social-login-settings');
    }

    public function update(Request $request, SocialLogin $socialLogin)
    {
        $this->validate($request, [
            'fb_client_id' => 'required',
            'fb_client_secret_key' => 'required',
            'g_client_id' => 'required',
            'g_client_secret_key' => 'required',
            'git_client_id' => 'required',
            'git_client_secret_key' => 'required'
        ]);

        $socialLogin->update([
            'fb_client_id' => $request->fb_client_id,
            'fb_client_secret_key' => $request->fb_client_secret_key,
            'fb_is_active' => $request->fb_is_active,
            'g_client_id' => $request->g_client_id,
            'g_client_secret_key' => $request->g_client_secret_key,
            'g_is_active' => $request->g_is_active,
            'git_client_id' => $request->git_client_id,
            'git_client_secret_key' => $request->git_client_secret_key,
            'git_is_active' => $request->git_is_active
        ]);

        // Github
        Artisan::call("env:set GITHUB_CLIENT_ID='" . $request->git_client_id . "'");
        Artisan::call("env:set GITHUB_CLIENT_SECRET='" . $request->git_client_secret_key . "'");

        // Google
        Artisan::call("env:set GOOGLE_CLIENT_ID='" . $request->g_client_id . "'");
        Artisan::call("env:set GOOGLE_CLIENT_SECRET='" . $request->g_client_secret_key . "'");

        // facebook
        Artisan::call("env:set FACEBOOK_CLIENT_ID='" . $request->fb_client_id . "'");
        Artisan::call("env:set FACEBOOK_CLIENT_SECRET='" . $request->fb_client_secret_key . "'");

        Session::flash('success', 'Status facebook login changed successfully');
        return back();
    }
}
