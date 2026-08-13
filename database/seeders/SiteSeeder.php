<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = Division::pluck('id', 'name');

        Site::firstOrCreate(
            ['name' => 'Dhaka'],
            ['division_id' => $divisions['Dhaka']]
        )->setStatus('active');
        Site::firstOrCreate(
            ['name' => 'Rajshahi'],
            ['division_id' => $divisions['Rajshahi']]
        )->setStatus('active');
        Site::firstOrCreate(
            ['name' => 'Chattogram'],
            ['division_id' => $divisions['Chattogram']]
        )->setStatus('active');
        Site::firstOrCreate(
            ['name' => 'Khulna'],
            ['division_id' => $divisions['Khulna']]
        )->setStatus('active');
        Site::firstOrCreate(
            ['name' => 'Sylhet'],
            ['division_id' => $divisions['Sylhet']]
        )->setStatus('active');
    }
}
