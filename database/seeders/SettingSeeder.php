<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::firstOrCreate(
            ['key' => 'ip_passing_score'],
            ['value' => '55', 'description' => 'IP exam passing score percentage'],
        )->setStatus('active');

        Setting::firstOrCreate(
            ['key' => 'fe_morning_passing_score'],
            ['value' => '60', 'description' => 'FE morning exam passing score percentage'],
        )->setStatus('active');

        Setting::firstOrCreate(
            ['key' => 'fe_afternoon_passing_score'],
            ['value' => '60', 'description' => 'FE afternoon exam passing score percentage'],
        )->setStatus('active');

        Setting::firstOrCreate(
            ['key' => 'ip_duration_minutes'],
            ['value' => '120', 'description' => 'IP exam duration in minutes'],
        )->setStatus('active');

        Setting::firstOrCreate(
            ['key' => 'fe_morning_duration_minutes'],
            ['value' => '90', 'description' => 'FE morning exam duration in minutes'],
        )->setStatus('active');

        Setting::firstOrCreate(
            ['key' => 'fe_afternoon_duration_minutes'],
            ['value' => '100', 'description' => 'FE afternoon exam duration in minutes'],
        )->setStatus('active');

        Setting::firstOrCreate(
            ['key' => 'minimum_age_years'],
            ['value' => '20', 'description' => 'Minimum age requirement for exam registration'],
        )->setStatus('active');

        Setting::firstOrCreate(
            ['key' => 'half_passer_validity_years'],
            ['value' => '1', 'description' => 'Years a half-passer has to clear the remaining exam'],
        )->setStatus('active');

        Setting::firstOrCreate(
            ['key' => 'half_passer_max_attempts'],
            ['value' => '2', 'description' => 'Maximum additional attempts for a half-passer'],
        )->setStatus('active');
    }
}
