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

        District::updateOrCreate(
            ['name' => 'Panchagarh'],
            ['name_bn' => 'পঞ্চগড়', 'division_id' => $divisions['Rangpur']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Thakurgaon'],
            ['name_bn' => 'ঠাকুরগাঁও', 'division_id' => $divisions['Rangpur']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Dinajpur'],
            ['name_bn' => 'দিনাজপুর', 'division_id' => $divisions['Rangpur']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Nilphamari'],
            ['name_bn' => 'নীলফামারী', 'division_id' => $divisions['Rangpur']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Lalmonirhat'],
            ['name_bn' => 'লালমনিরহাট', 'division_id' => $divisions['Rangpur']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Rangpur'],
            ['name_bn' => 'রংপুর', 'division_id' => $divisions['Rangpur']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Kurigram'],
            ['name_bn' => 'কুড়িগ্রাম', 'division_id' => $divisions['Rangpur']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Gaibandha'],
            ['name_bn' => 'গাইবান্ধা', 'division_id' => $divisions['Rangpur']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Joypurhat'],
            ['name_bn' => 'জয়পুরহাট', 'division_id' => $divisions['Rajshahi']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Bogura'],
            ['name_bn' => 'বগুড়া', 'division_id' => $divisions['Rajshahi']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Chapai Nawabganj'],
            ['name_bn' => 'চাঁপাই নবাবগঞ্জ', 'division_id' => $divisions['Rajshahi']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Naogaon'],
            ['name_bn' => 'নওগাঁ', 'division_id' => $divisions['Rajshahi']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Rajshahi'],
            ['name_bn' => 'রাজশাহী', 'division_id' => $divisions['Rajshahi']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Natore'],
            ['name_bn' => 'নাটোর', 'division_id' => $divisions['Rajshahi']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Sirajganj'],
            ['name_bn' => 'সিরাজগঞ্জ', 'division_id' => $divisions['Rajshahi']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Pabna'],
            ['name_bn' => 'পাবনা', 'division_id' => $divisions['Rajshahi']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Meherpur'],
            ['name_bn' => 'মেহেরপুর', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Kushtia'],
            ['name_bn' => 'কুষ্টিয়া', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Chuadanga'],
            ['name_bn' => 'চুয়াডাঙ্গা', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Jhenaidah'],
            ['name_bn' => 'ঝিনাইদহ', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Jashore'],
            ['name_bn' => 'যশোর', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Magura'],
            ['name_bn' => 'মাগুরা', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Narail'],
            ['name_bn' => 'নড়াইল', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Bagerhat'],
            ['name_bn' => 'বাগেরহাট', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Khulna'],
            ['name_bn' => 'খুলনা', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Satkhira'],
            ['name_bn' => 'সাতক্ষীরা', 'division_id' => $divisions['Khulna']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Barguna'],
            ['name_bn' => 'বরগুনা', 'division_id' => $divisions['Barishal']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Patuakhali'],
            ['name_bn' => 'পটুয়াখালী', 'division_id' => $divisions['Barishal']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Bhola'],
            ['name_bn' => 'ভোলা', 'division_id' => $divisions['Barishal']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Barishal'],
            ['name_bn' => 'বরিশাল', 'division_id' => $divisions['Barishal']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Jhalokati'],
            ['name_bn' => 'ঝালকাঠি', 'division_id' => $divisions['Barishal']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Pirojpur'],
            ['name_bn' => 'পিরোজপুর', 'division_id' => $divisions['Barishal']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Tangail'],
            ['name_bn' => 'টাঙ্গাইল', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Kishoreganj'],
            ['name_bn' => 'কিশোরগঞ্জ', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Manikganj'],
            ['name_bn' => 'মানিকগঞ্জ', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Munshiganj'],
            ['name_bn' => 'মুন্সিগঞ্জ', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Dhaka'],
            ['name_bn' => 'ঢাকা', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Gazipur'],
            ['name_bn' => 'গাজীপুর', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Narsingdi'],
            ['name_bn' => 'নরসীংদী', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Narayanganj'],
            ['name_bn' => 'নারায়নগঞ্জ', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Rajbari'],
            ['name_bn' => 'রাজবাড়ী', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Faridpur'],
            ['name_bn' => 'ফরিদপুর', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Gopalganj'],
            ['name_bn' => 'গোপালগঞ্জ', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Madaripur'],
            ['name_bn' => 'মাদারীপুর', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Shariatpur'],
            ['name_bn' => 'শরীয়তপুর', 'division_id' => $divisions['Dhaka']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Jamalpur'],
            ['name_bn' => 'জামালপুর', 'division_id' => $divisions['Mymensingh']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Sherpur'],
            ['name_bn' => 'শেরপুর', 'division_id' => $divisions['Mymensingh']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Mymensingh'],
            ['name_bn' => 'ময়মনসিংহ', 'division_id' => $divisions['Mymensingh']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Netrokona'],
            ['name_bn' => 'নেত্রকোণা', 'division_id' => $divisions['Mymensingh']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Sunamganj'],
            ['name_bn' => 'সুনামগঞ্জ', 'division_id' => $divisions['Sylhet']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Sylhet'],
            ['name_bn' => 'সিলেট', 'division_id' => $divisions['Sylhet']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Moulvibazar'],
            ['name_bn' => 'মৌলভীবাজার', 'division_id' => $divisions['Sylhet']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Habiganj'],
            ['name_bn' => 'হবিগঞ্জ', 'division_id' => $divisions['Sylhet']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Brahmanbaria'],
            ['name_bn' => 'ব্রাহ্মণবাড়িয়া', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Cumilla'],
            ['name_bn' => 'কুমিল্লা', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Chandpur'],
            ['name_bn' => 'চাঁদপুর', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Feni'],
            ['name_bn' => 'ফেনী', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Noakhali'],
            ['name_bn' => 'নোয়াখালী', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Lakshmipur'],
            ['name_bn' => 'লক্ষীপুর', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Chattogram'],
            ['name_bn' => 'চট্টগ্রাম', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => "Cox's Bazar"],
            ['name_bn' => 'কক্সবাজার', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Khagrachhari'],
            ['name_bn' => 'খাগড়াছড়ি', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Rangamati'],
            ['name_bn' => 'রাঙ্গামাটি', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
        District::updateOrCreate(
            ['name' => 'Bandarban'],
            ['name_bn' => 'বান্দরবন', 'division_id' => $divisions['Chattogram']],
        )->setStatus('active');
    }
}
