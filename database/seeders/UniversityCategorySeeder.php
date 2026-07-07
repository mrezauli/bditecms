<?php

namespace Database\Seeders;

use App\Models\UniversityCategory;
use Illuminate\Database\Seeder;

class UniversityCategorySeeder extends Seeder
{
    public function run(): void
    {
        UniversityCategory::firstOrCreate(['name' => 'International']);
        UniversityCategory::firstOrCreate(['name' => 'Public']);
        UniversityCategory::firstOrCreate(['name' => 'Private']);
    }
}
