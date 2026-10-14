<?php

namespace Database\Seeders;

use App\Models\UniversityCategory;
use Illuminate\Database\Seeder;

class UniversityCategorySeeder extends Seeder
{
    public function run(): void
    {
        UniversityCategory::updateOrCreate(['name' => 'International']);
        UniversityCategory::updateOrCreate(['name' => 'Public']);
        UniversityCategory::updateOrCreate(['name' => 'Private']);
    }
}
