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

        Site::updateOrCreate(
            ['name' => 'Dhaka'],
            ['division_id' => $divisions['Dhaka']]
        )->setStatus('active');
        Site::updateOrCreate(
            ['name' => 'Rajshahi'],
            ['division_id' => $divisions['Rajshahi']]
        )->setStatus('active');
        Site::updateOrCreate(
            ['name' => 'Chattogram'],
            ['division_id' => $divisions['Chattogram']]
        )->setStatus('active');
        Site::updateOrCreate(
            ['name' => 'Khulna'],
            ['division_id' => $divisions['Khulna']]
        )->setStatus('active');
        Site::updateOrCreate(
            ['name' => 'Sylhet'],
            ['division_id' => $divisions['Sylhet']]
        )->setStatus('active');
    }
}
