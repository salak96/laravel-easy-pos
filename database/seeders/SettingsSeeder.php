<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'currency_symbol', 'value' => 'Rp'],
            ['key' => 'site_description', 'value' => 'Alamat: 7HJM+9V5, Bendogantungan, Sumberejo, Kec. Klaten Sel., Kabupaten Klaten, Jawa Tengah 57426'],
            ['key' => 'site_email', 'value' => 'admin@example.com'],
            ['key' => 'site_name', 'value' => 'Pecel Lele LENTERA']
        ];
        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
