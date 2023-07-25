<?php

namespace Database\Seeders;

use App\Models\MailSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailSetting::create([
            'mail_mailer' => 'smtp',
            'mail_host' => 'sandbox.smtp.mailtrap.io',
            'mail_port' => '2525',
            'mail_username' => 'b28614423cf6aa',
            'mail_password' => '68c9b2dd67e460',
            'mail_encryption' => 'tls',
            'mail_from_address' => 'info@example.com',
            'mail_from_name' => 'Master Apps',
        ]);
    }
}
