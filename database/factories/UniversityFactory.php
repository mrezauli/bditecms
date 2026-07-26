<?php

namespace Database\Factories;

use App\Models\University;
use App\Models\UniversityCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<University>
 */
class UniversityFactory extends Factory
{
    protected static array $universities = [
        ['name' => 'University of Dhaka', 'acronym' => 'DU'],
        ['name' => 'Bangladesh University of Engineering and Technology', 'acronym' => 'BUET'],
        ['name' => 'Rajshahi University', 'acronym' => 'RU'],
        ['name' => 'Khulna University of Engineering and Technology', 'acronym' => 'KUET'],
        ['name' => 'Shahjalal University of Science and Technology', 'acronym' => 'SUST'],
        ['name' => 'North South University', 'acronym' => 'NSU'],
        ['name' => 'BRAC University', 'acronym' => 'BRACU'],
        ['name' => 'American International University-Bangladesh', 'acronym' => 'AIUB'],
        ['name' => 'Daffodil International University', 'acronym' => 'DIU'],
        ['name' => 'East West University', 'acronym' => 'EWU'],
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        $u = static::$universities[static::$index % count(static::$universities)];

        return [
            'name' => $u['name'],
            'acronym' => $u['acronym'],
            'website' => 'https://www.'.strtolower($u['acronym']).'.edu.bd',
            'university_category_id' => UniversityCategory::inRandomOrder()->value('id') ?? UniversityCategory::factory(),
        ];
    }
}
