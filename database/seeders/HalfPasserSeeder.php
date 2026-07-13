<?php

namespace Database\Seeders;

use App\Models\HalfPasser;
use Illuminate\Database\Seeder;

class HalfPasserSeeder extends Seeder
{
    public function run(): void
    {
        $morningExam = [
            ['FE01-0023', 'Md. Farhad Hoshen Bakaul', 'Passed in April 2024 Exam'],
            ['FE01-0029', 'Abdhul Latheef Althaf', null],
            ['FE01-0072', 'Fariha Rahman Saba', null],
            ['FE01-0174', 'MD SAIF HOSSAIN', null],
            ['FE01-0184', 'Rakib Bin Kabir', null],
            ['FE01-0240', 'Arafat Hossain', null],
            ['FE04-0010', 'Soummo Bhattacharya', null],
            ['FE01-0001', 'MD. Naeem', 'Passed in October 2023 Exam'],
            ['FE01-0007', 'Rahma Alam Samiha', null],
            ['FE01-0038', 'Md. Mahmud Alam', null],
            ['FE01-0048', 'Shawkat Ali Sujon', null],
            ['FE01-0052', 'MD. ASHIKUR RAHMAN', null],
            ['FE01-0060', 'Md. Idris Ali Sayem', null],
            ['FE01-0068', 'Mahin Mustafiz Sami', null],
            ['FE01-0110', 'MD. RAFI AHMED', null],
            ['FE01-0111', 'M Saymon Islam Iftikar', null],
            ['FE01-0132', 'Zeshan Ahmed', null],
            ['FE01-0135', 'MUBASHER ADNAN JIHAD', null],
            ['FE01-0148', 'Md Atikul Islam', null],
            ['FE01-0156', 'Khaled Hasan Irfan', null],
            ['FE01-0169', 'Junaed Hossain Jibon', null],
            ['FE01-0180', 'Md. Safiqur Rahman', null],
            ['FE01-0202', 'Anisur Rahman Mahmud', null],
            ['FE01-0208', 'Sanzida Akter', null],
            ['FE01-0266', 'Mohammad Zaid Iqbal Fahad', null],
            ['FE01-0272', 'Asmaul Shahana Begum', null],
            ['FE01-0310', 'Rafiea Nusrat Mim', null],
            ['FE01-0314', 'Arafat Hossain Anik', null],
            ['FE01-0316', 'Md. Naimul Islam Sijan', null],
            ['FE01-0319', 'Abdullah Al Mamun', null],
            ['FE01-0332', 'MD. Touhidul Islam Rifat', null],
            ['FE01-0337', 'Anindita Acharjee', null],
            ['FE02-0007', 'Raiyan Zannat', null],
            ['FE02-0012', 'MD RAYHAN ALI', null],
            ['FE03-0011', 'MD. TANVIR RUBAYED TAUHID', null],
            ['FE03-0023', 'Walid Ibn Zinnah Ayon', null],
            ['FE04-0009', 'Avishek Roy', null],
            ['FE04-0010', 'MD. Mahbubur Rahman', null],
            ['FE04-0012', 'Anupoma Debnath', null],
        ];

        $afternoonExam = [
            ['FE01-0056', 'Afia Sultana Shimu', 'Passed in April 2024 Exam'],
            ['FE01-0059', 'Durjoy Kumar Sutrodhar', null],
            ['FE01-0060', 'Md Azman Hossain', null],
            ['FE01-0071', 'Nafiul Huda', null],
            ['FE01-0092', 'Tanzila Akter', null],
            ['FE01-0102', 'TAHSIN SHADMAN', null],
            ['FE01-0107', 'MD. Shahed Annam', null],
            ['FE01-0110', 'Pollob Chandra Ray', null],
            ['FE01-0148', 'ADIBUL HAQUE', null],
            ['FE01-0152', 'Hemel Sharker Akash', null],
            ['FE01-0157', 'Arifur Rahman', null],
            ['FE01-0178', 'Irtifa Haider', null],
            ['FE01-0179', 'Seaum Ahmed Tazim', null],
            ['FE01-0186', 'Mahfuza Mahnaz', null],
            ['FE01-0205', 'Md Nur Nobi', null],
            ['FE02-0001', 'LIHAN AHMED', null],
            ['FE02-0012', 'Md. Sumon Ali', null],
            ['FE02-0016', 'Md. Shahrier Mallick', null],
            ['FE02-0018', 'Sheikh Zubayer', null],
            ['FE03-0008', 'Md.Yeasin Arafat', null],
            ['FE03-0009', 'Priya Barua', null],
            ['FE03-0010', 'Shanewaz Aurnob', null],
            ['FE03-0013', 'Farhana Sultana Ananna', null],
            ['FE04-0004', 'Aciful Islam Khan Swopnile', null],
            ['FE04-0016', 'Atiqul Islam Atik', null],
            ['FE01-0025', 'Mahmud Alam', 'Passed in October 2023 Exam'],
            ['FE01-0033', 'Sabikun Nahar Zerin', null],
            ['FE01-0039', 'Afia Jahin', null],
            ['FE01-0084', 'Md. Janay Alam', null],
            ['FE01-0121', 'M. M. Jahid Hasan', null],
            ['FE01-0197', 'NISHI CHAKMA', null],
            ['FE01-0231', 'Md Adnan Hossain', null],
            ['FE01-0290', 'Mehedi Hasan', null],
            ['FE01-0318', 'Sadia Islam', null],
            ['FE01-0330', 'MD. SYMUM HOSSAIN', null],
            ['FE02-0010', 'Tushar Das', null],
            ['FE02-0025', 'MONDOL MRIDUL PROVAKAR', null],
            ['FE04-0004', 'CHINMOY MODAK TURJO', null],
            ['FE04-0005', 'Pantho Haque', null],
            ['FE04-0008', 'Nusrat Jahan Jonaki', null],
        ];

        foreach ($morningExam as [$examineeNo, $name, $remarks]) {
            HalfPasser::firstOrCreate(
                ['examinee_no' => $examineeNo, 'exam_type' => 'Morning Exam'],
                [
                    'name' => $name,
                    'remarks' => $remarks,
                ],
            );
        }

        foreach ($afternoonExam as [$examineeNo, $name, $remarks]) {
            HalfPasser::firstOrCreate(
                ['examinee_no' => $examineeNo, 'exam_type' => 'Afternoon Exam'],
                [
                    'name' => $name,
                    'remarks' => $remarks,
                ],
            );
        }
    }
}
