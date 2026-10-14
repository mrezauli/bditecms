<?php

namespace Database\Seeders;

use App\Models\IssueCategory;
use Illuminate\Database\Seeder;

class IssueCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Payment', 'Exam', 'Account', 'General'];

        foreach ($categories as $name) {
            IssueCategory::updateOrCreate(['name' => $name]);
        }
    }
}
