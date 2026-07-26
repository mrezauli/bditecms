<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Site>
 */
class SiteFactory extends Factory
{
    protected static array $sites = [
        'Dhaka', 'Chittagong', 'Rajshahi', 'Khulna', 'Sylhet',
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        return [
            'name' => static::$sites[static::$index % count(static::$sites)],
        ];
    }
}
