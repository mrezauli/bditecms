<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        Site::firstOrCreate(['name' => 'Dhaka'])->setStatus('active');
        Site::firstOrCreate(['name' => 'Rajshahi'])->setStatus('active');
        Site::firstOrCreate(['name' => 'Chittagong'])->setStatus('active');
        Site::firstOrCreate(['name' => 'Khulna'])->setStatus('active');
        Site::firstOrCreate(['name' => 'Sylhet'])->setStatus('active');
    }
}
