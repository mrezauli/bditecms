<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        Division::updateOrCreate(['name' => 'Rangpur'], ['name_bn' => 'রংপুর'])->setStatus('active');
        Division::updateOrCreate(['name' => 'Rajshahi'], ['name_bn' => 'রাজশাহী'])->setStatus('active');
        Division::updateOrCreate(['name' => 'Khulna'], ['name_bn' => 'খুলনা'])->setStatus('active');
        Division::updateOrCreate(['name' => 'Barishal'], ['name_bn' => 'বরিশাল'])->setStatus('active');
        Division::updateOrCreate(['name' => 'Dhaka'], ['name_bn' => 'ঢাকা'])->setStatus('active');
        Division::updateOrCreate(['name' => 'Mymensingh'], ['name_bn' => 'ময়মনসিংহ'])->setStatus('active');
        Division::updateOrCreate(['name' => 'Sylhet'], ['name_bn' => 'সিলেট'])->setStatus('active');
        Division::updateOrCreate(['name' => 'Chattogram'], ['name_bn' => 'চট্টগ্রাম'])->setStatus('active');
    }
}
