<?php

namespace Database\Seeders;

use App\Models\SuperAdminSetting;
use Illuminate\Database\Seeder;

class SuperAdminSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageUrl = ('web/img/selfcare-logo.png');
        $favicon = ('web/img/selfcare-favicon.ico');

        SuperAdminSetting::create(['key' => 'app_name', 'value' => 'Self Care']);
        SuperAdminSetting::create(['key' => 'app_logo', 'value' => $imageUrl]);
        SuperAdminSetting::create(['key' => 'favicon', 'value' => $favicon]);
    }
}
