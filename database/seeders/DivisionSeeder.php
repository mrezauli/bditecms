<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        Division::firstOrCreate(['name' => 'Rangpur'], ['name_bn' => 'রংপুর'])->setStatus('active');
        Division::firstOrCreate(['name' => 'Rajshahi'], ['name_bn' => 'রাজশাহী'])->setStatus('active');
        Division::firstOrCreate(['name' => 'Khulna'], ['name_bn' => 'খুলনা'])->setStatus('active');
        Division::firstOrCreate(['name' => 'Barishal'], ['name_bn' => 'বরিশাল'])->setStatus('active');
        Division::firstOrCreate(['name' => 'Dhaka'], ['name_bn' => 'ঢাকা'])->setStatus('active');
        Division::firstOrCreate(['name' => 'Mymensingh'], ['name_bn' => 'ময়মনসিংহ'])->setStatus('active');
        Division::firstOrCreate(['name' => 'Sylhet'], ['name_bn' => 'সিলেট'])->setStatus('active');
        Division::firstOrCreate(['name' => 'Chattogram'], ['name_bn' => 'চট্টগ্রাম'])->setStatus('active');
    }
}
