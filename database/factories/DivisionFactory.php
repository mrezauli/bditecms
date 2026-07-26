<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Division>
 */
class DivisionFactory extends Factory
{
    protected static array $divisions = [
        'Dhaka', 'Chattogram', 'Rajshahi', 'Khulna', 'Barishal',
        'Sylhet', 'Rangpur', 'Mymensingh',
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        return [
            'name' => static::$divisions[static::$index % count(static::$divisions)],
        ];
    }
}
