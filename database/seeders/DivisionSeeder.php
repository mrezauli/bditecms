<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        Division::firstOrCreate(['name' => 'রংপুর'])->setStatus('active');
        Division::firstOrCreate(['name' => 'রাজশাহী'])->setStatus('active');
        Division::firstOrCreate(['name' => 'খুলনা'])->setStatus('active');
        Division::firstOrCreate(['name' => 'বরিশাল'])->setStatus('active');
        Division::firstOrCreate(['name' => 'ঢাকা'])->setStatus('active');
        Division::firstOrCreate(['name' => 'ময়মনসিংহ'])->setStatus('active');
        Division::firstOrCreate(['name' => 'সিলেট'])->setStatus('active');
        Division::firstOrCreate(['name' => 'চট্টগ্রাম'])->setStatus('active');
    }
}
