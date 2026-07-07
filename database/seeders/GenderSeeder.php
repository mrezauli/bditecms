<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        Gender::firstOrCreate(['name' => 'Male'])->setStatus('active');
        Gender::firstOrCreate(['name' => 'Female'])->setStatus('active');
    }
}
