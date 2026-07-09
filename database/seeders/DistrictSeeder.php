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
            ['name' => 'Panchagarh'],
            ['name_bn' => 'পঞ্চগড়', 'division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Thakurgaon'],
            ['name_bn' => 'ঠাকুরগাঁও', 'division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Dinajpur'],
            ['name_bn' => 'দিনাজপুর', 'division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Nilphamari'],
            ['name_bn' => 'নীলফামারী', 'division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Lalmonirhat'],
            ['name_bn' => 'লালমনিরহাট', 'division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Rangpur'],
            ['name_bn' => 'রংপুর', 'division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Kurigram'],
            ['name_bn' => 'কুড়িগ্রাম', 'division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Gaibandha'],
            ['name_bn' => 'গাইবান্ধা', 'division_id' => $divisions['রংপুর']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Joypurhat'],
            ['name_bn' => 'জয়পুরহাট', 'division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Bogura'],
            ['name_bn' => 'বগুড়া', 'division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Chapai Nawabganj'],
            ['name_bn' => 'চাঁপাই নবাবগঞ্জ', 'division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Naogaon'],
            ['name_bn' => 'নওগাঁ', 'division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Rajshahi'],
            ['name_bn' => 'রাজশাহী', 'division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Natore'],
            ['name_bn' => 'নাটোর', 'division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Sirajganj'],
            ['name_bn' => 'সিরাজগঞ্জ', 'division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Pabna'],
            ['name_bn' => 'পাবনা', 'division_id' => $divisions['রাজশাহী']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Meherpur'],
            ['name_bn' => 'মেহেরপুর', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Kushtia'],
            ['name_bn' => 'কুষ্টিয়া', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Chuadanga'],
            ['name_bn' => 'চুয়াডাঙ্গা', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Jhenaidah'],
            ['name_bn' => 'ঝিনাইদহ', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Jashore'],
            ['name_bn' => 'যশোর', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Magura'],
            ['name_bn' => 'মাগুরা', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Narail'],
            ['name_bn' => 'নড়াইল', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Bagerhat'],
            ['name_bn' => 'বাগেরহাট', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Khulna'],
            ['name_bn' => 'খুলনা', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Satkhira'],
            ['name_bn' => 'সাতক্ষীরা', 'division_id' => $divisions['খুলনা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Barguna'],
            ['name_bn' => 'বরগুনা', 'division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Patuakhali'],
            ['name_bn' => 'পটুয়াখালী', 'division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Bhola'],
            ['name_bn' => 'ভোলা', 'division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Barishal'],
            ['name_bn' => 'বরিশাল', 'division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Jhalokati'],
            ['name_bn' => 'ঝালকাঠি', 'division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Pirojpur'],
            ['name_bn' => 'পিরোজপুর', 'division_id' => $divisions['বরিশাল']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Tangail'],
            ['name_bn' => 'টাঙ্গাইল', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Kishoreganj'],
            ['name_bn' => 'কিশোরগঞ্জ', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Manikganj'],
            ['name_bn' => 'মানিকগঞ্জ', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Munshiganj'],
            ['name_bn' => 'মুন্সিগঞ্জ', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Dhaka'],
            ['name_bn' => 'ঢাকা', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Gazipur'],
            ['name_bn' => 'গাজীপুর', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Narsingdi'],
            ['name_bn' => 'নরসীংদী', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Narayanganj'],
            ['name_bn' => 'নারায়নগঞ্জ', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Rajbari'],
            ['name_bn' => 'রাজবাড়ী', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Faridpur'],
            ['name_bn' => 'ফরিদপুর', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Gopalganj'],
            ['name_bn' => 'গোপালগঞ্জ', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Madaripur'],
            ['name_bn' => 'মাদারীপুর', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Shariatpur'],
            ['name_bn' => 'শরীয়তপুর', 'division_id' => $divisions['ঢাকা']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Jamalpur'],
            ['name_bn' => 'জামালপুর', 'division_id' => $divisions['ময়মনসিংহ']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Sherpur'],
            ['name_bn' => 'শেরপুর', 'division_id' => $divisions['ময়মনসিংহ']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Mymensingh'],
            ['name_bn' => 'ময়মনসিংহ', 'division_id' => $divisions['ময়মনসিংহ']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Netrokona'],
            ['name_bn' => 'নেত্রকোণা', 'division_id' => $divisions['ময়মনসিংহ']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Sunamganj'],
            ['name_bn' => 'সুনামগঞ্জ', 'division_id' => $divisions['সিলেট']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Sylhet'],
            ['name_bn' => 'সিলেট', 'division_id' => $divisions['সিলেট']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Moulvibazar'],
            ['name_bn' => 'মৌলভীবাজার', 'division_id' => $divisions['সিলেট']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Habiganj'],
            ['name_bn' => 'হবিগঞ্জ', 'division_id' => $divisions['সিলেট']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Brahmanbaria'],
            ['name_bn' => 'ব্রাহ্মণবাড়িয়া', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Cumilla'],
            ['name_bn' => 'কুমিল্লা', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Chandpur'],
            ['name_bn' => 'চাঁদপুর', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Feni'],
            ['name_bn' => 'ফেনী', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Noakhali'],
            ['name_bn' => 'নোয়াখালী', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Lakshmipur'],
            ['name_bn' => 'লক্ষীপুর', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Chattogram'],
            ['name_bn' => 'চট্টগ্রাম', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => "Cox's Bazar"],
            ['name_bn' => 'কক্সবাজার', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Khagrachhari'],
            ['name_bn' => 'খাগড়াছড়ি', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Rangamati'],
            ['name_bn' => 'রাঙ্গামাটি', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
        District::firstOrCreate(
            ['name' => 'Bandarban'],
            ['name_bn' => 'বান্দরবন', 'division_id' => $divisions['চট্টগ্রাম']],
        )->setStatus('active');
    }
}
