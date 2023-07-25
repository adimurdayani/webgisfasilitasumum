<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class MailSettingController extends Controller
{
    public function index()
    {
        Gate::authorize('app.mails.index');
        $mail = MailSetting::where('id', 1)->first();
        if (empty($mail)) {
            return view('errors', [
                'code' => 404,
                'message' => 'Page not found!'
            ], 404);
        } else {
            return view('backend.settings.mail-setting', compact('mail'));
        }
    }

    public function update(Request $request, MailSetting $mailSetting)
    {
        $this->validate($request, [
            'mail_mailer' => 'required|string|max:255',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required',
            'mail_username' => 'required|string|max:255',
            'mail_password' => 'required|string|max:255',
            'mail_encryption' => 'required|string|max:255',
            'mail_from_address' => 'required|string|max:255',
            'mail_from_name' => 'required|string|max:255',
        ]);

        $mailSetting->update([
            'mail_mailer' => $request->mail_mailer,
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_encryption' => $request->mail_encryption,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name' => $request->mail_from_name,
        ]);
        Artisan::call('env:set MAIL_MAILER="' . $request->mail_mailer . '"');
        Artisan::call('env:set MAIL_HOST="' . $request->mail_host . '"');
        Artisan::call('env:set MAIL_PORT="' . $request->mail_port . '"');
        Artisan::call('env:set MAIL_USERNAME="' . $request->mail_username . '"');
        Artisan::call('env:set MAIL_PASSWORD="' . $request->mail_password . '"');
        Artisan::call('env:set MAIL_ENCRYPTION="' . $request->mail_encryption . '"');
        Artisan::call('env:set MAIL_FROM_ADDRESS="' . $request->mail_from_address . '"');
        Artisan::call('env:set MAIL_FROM_NAME="' . $request->mail_from_name . '"');

        Session::flash('success', 'Mail setting created successfully');
        return back();
    }
}
