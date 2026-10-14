<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        Gender::updateOrCreate(['name' => 'Male'])->setStatus('active');
        Gender::updateOrCreate(['name' => 'Female'])->setStatus('active');
    }
}
