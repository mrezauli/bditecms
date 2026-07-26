<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Setting>
 */
class SettingFactory extends Factory
{
    protected static array $settings = [
        ['key' => 'ip_passing_score', 'value' => '55', 'desc' => 'IP exam passing score percentage'],
        ['key' => 'fe_morning_passing_score', 'value' => '60', 'desc' => 'FE morning exam passing score percentage'],
        ['key' => 'fe_afternoon_passing_score', 'value' => '60', 'desc' => 'FE afternoon exam passing score percentage'],
        ['key' => 'ip_duration_minutes', 'value' => '120', 'desc' => 'IP exam duration in minutes'],
        ['key' => 'fe_morning_duration_minutes', 'value' => '90', 'desc' => 'FE morning exam duration in minutes'],
        ['key' => 'fe_afternoon_duration_minutes', 'value' => '100', 'desc' => 'FE afternoon exam duration in minutes'],
        ['key' => 'minimum_age_years', 'value' => '20', 'desc' => 'Minimum age requirement for exam registration'],
        ['key' => 'half_passer_validity_years', 'value' => '1', 'desc' => 'Years a half-passer has to clear the remaining exam'],
        ['key' => 'half_passer_max_attempts', 'value' => '2', 'desc' => 'Maximum additional attempts for a half-passer'],
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        $s = static::$settings[static::$index % count(static::$settings)];

        return [
            'key' => $s['key'],
            'value' => $s['value'],
            'description' => $s['desc'],
        ];
    }
}
