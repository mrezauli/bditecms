<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<District>
 */
class DistrictFactory extends Factory
{
    protected static array $districts = [
        ['name' => 'Dhaka', 'name_bn' => 'ঢাকা'],
        ['name' => 'Gazipur', 'name_bn' => 'গাজীপুর'],
        ['name' => 'Narayanganj', 'name_bn' => 'নারায়ণগঞ্জ'],
        ['name' => 'Chattogram', 'name_bn' => 'চট্টগ্রাম'],
        ['name' => 'Cox\'s Bazar', 'name_bn' => 'কক্সবাজার'],
        ['name' => 'Rajshahi', 'name_bn' => 'রাজশাহী'],
        ['name' => 'Bogra', 'name_bn' => 'বগুড়া'],
        ['name' => 'Khulna', 'name_bn' => 'খুলনা'],
        ['name' => 'Jessore', 'name_bn' => 'যশোর'],
        ['name' => 'Sylhet', 'name_bn' => 'সিলেট'],
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        $d = static::$districts[static::$index % count(static::$districts)];

        return [
            'name' => $d['name'],
            'name_bn' => $d['name_bn'],
            'division_id' => Division::inRandomOrder()->value('id') ?? Division::factory(),
        ];
    }
}
