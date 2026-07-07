<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Division;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = Division::pluck('id', 'name');

        District::firstOrCreate(
            ['name' => 'পঞ্চগড়'],
            ['division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ঠাকুরগাঁও'],
            ['division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'দিনাজপুর'],
            ['division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'নীলফামারী'],
            ['division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'লালমনিরহাট'],
            ['division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'রংপুর'],
            ['division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'কুড়িগ্রাম'],
            ['division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'গাইবান্ধা'],
            ['division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'জয়পুরহাট'],
            ['division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'বগুড়া'],
            ['division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'চাঁপাই নবাবগঞ্জ'],
            ['division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'নওগাঁ'],
            ['division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'রাজশাহী'],
            ['division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'নাটোর'],
            ['division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'সিরাজগঞ্জ'],
            ['division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'পাবনা'],
            ['division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'মেহেরপুর'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'কুষ্টিয়া'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'চুয়াডাঙ্গা'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ঝিনাইদহ'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'যশোর'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'মাগুরা'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'নড়াইল'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'বাগেরহাট'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'খুলনা'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'সাতক্ষীরা'],
            ['division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'বরগুনা'],
            ['division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'পটুয়াখালী'],
            ['division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ভোলা'],
            ['division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'বরিশাল'],
            ['division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ঝালকাঠি'],
            ['division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'পিরোজপুর'],
            ['division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'টাঙ্গাইল'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'কিশোরগঞ্জ'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'মানিকগঞ্জ'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'মুন্সিগঞ্জ'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ঢাকা'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'গাজীপুর'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'নরসীংদী'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'নারায়নগঞ্জ'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'রাজবাড়ী'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ফরিদপুর'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'গোপালগঞ্জ'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'মাদারীপুর'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'শরীয়তপুর'],
            ['division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'জামালপুর'],
            ['division_id' => $divisions['ময়মনসিংহ']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'শেরপুর'],
            ['division_id' => $divisions['ময়মনসিংহ']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ময়মনসিংহ'],
            ['division_id' => $divisions['ময়মনসিংহ']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'নেত্রকোণা'],
            ['division_id' => $divisions['ময়মনসিংহ']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'সুনামগঞ্জ'],
            ['division_id' => $divisions['সিলেট']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'সিলেট'],
            ['division_id' => $divisions['সিলেট']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'মৌলভীবাজার'],
            ['division_id' => $divisions['সিলেট']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'হবিগঞ্জ'],
            ['division_id' => $divisions['সিলেট']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ব্রাহ্মণবাড়িয়া'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'কুমিল্লা'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'চাঁদপুর'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'ফেনী'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'নোয়াখালী'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'লক্ষীপুর'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'চট্টগ্রাম'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'কক্সবাজার'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'খাগড়াছড়ি'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'রাঙ্গামাটি'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'বান্দরবন'],
            ['division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
    }
}
