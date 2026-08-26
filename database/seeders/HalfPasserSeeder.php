<?php

namespace Database\Seeders;

use App\Models\HalfPasser;
use App\Models\Intake;
use App\Models\Type;
use Illuminate\Database\Seeder;

class HalfPasserSeeder extends Seeder
{
    public function run(): void
    {
        $morningTypeId = Type::where('name', 'FE: Morning Exam')->value('id');
        $afternoonTypeId = Type::where('name', 'FE: Afternoon Exam')->value('id');

        $morningExam = [
            ['FE01-0023', 'Md. Farhad Hoshen Bakaul', 'Passed in April 2024 Exam'],
            ['FE01-0029', 'Abdhul Latheef Althaf', 'Passed in April 2024 Exam'],
            ['FE01-0072', 'Fariha Rahman Saba', 'Passed in April 2024 Exam'],
            ['FE01-0174', 'MD SAIF HOSSAIN', 'Passed in April 2024 Exam'],
            ['FE01-0184', 'Rakib Bin Kabir', 'Passed in April 2024 Exam'],
            ['FE01-0240', 'Arafat Hossain', 'Passed in April 2024 Exam'],
            ['FE04-0010', 'Soummo Bhattacharya', 'Passed in April 2024 Exam'],
            ['FE01-0001', 'MD. Naeem', 'Passed in October 2023 Exam'],
            ['FE01-0007', 'Rahma Alam Samiha', 'Passed in October 2023 Exam'],
            ['FE01-0038', 'Md. Mahmud Alam', 'Passed in October 2023 Exam'],
            ['FE01-0048', 'Shawkat Ali Sujon', 'Passed in October 2023 Exam'],
            ['FE01-0052', 'MD. ASHIKUR RAHMAN', 'Passed in October 2023 Exam'],
            ['FE01-0060', 'Md. Idris Ali Sayem', 'Passed in October 2023 Exam'],
            ['FE01-0068', 'Mahin Mustafiz Sami', 'Passed in October 2023 Exam'],
            ['FE01-0110', 'MD. RAFI AHMED', 'Passed in October 2023 Exam'],
            ['FE01-0111', 'M Saymon Islam Iftikar', 'Passed in October 2023 Exam'],
            ['FE01-0132', 'Zeshan Ahmed', 'Passed in October 2023 Exam'],
            ['FE01-0135', 'MUBASHER ADNAN JIHAD', 'Passed in October 2023 Exam'],
            ['FE01-0148', 'Md Atikul Islam', 'Passed in October 2023 Exam'],
            ['FE01-0156', 'Khaled Hasan Irfan', 'Passed in October 2023 Exam'],
            ['FE01-0169', 'Junaed Hossain Jibon', 'Passed in October 2023 Exam'],
            ['FE01-0180', 'Md. Safiqur Rahman', 'Passed in October 2023 Exam'],
            ['FE01-0202', 'Anisur Rahman Mahmud', 'Passed in October 2023 Exam'],
            ['FE01-0208', 'Sanzida Akter', 'Passed in October 2023 Exam'],
            ['FE01-0266', 'Mohammad Zaid Iqbal Fahad', 'Passed in October 2023 Exam'],
            ['FE01-0272', 'Asmaul Shahana Begum', 'Passed in October 2023 Exam'],
            ['FE01-0310', 'Rafiea Nusrat Mim', 'Passed in October 2023 Exam'],
            ['FE01-0314', 'Arafat Hossain Anik', 'Passed in October 2023 Exam'],
            ['FE01-0316', 'Md. Naimul Islam Sijan', 'Passed in October 2023 Exam'],
            ['FE01-0319', 'Abdullah Al Mamun', 'Passed in October 2023 Exam'],
            ['FE01-0332', 'MD. Touhidul Islam Rifat', 'Passed in October 2023 Exam'],
            ['FE01-0337', 'Anindita Acharjee', 'Passed in October 2023 Exam'],
            ['FE02-0007', 'Raiyan Zannat', 'Passed in October 2023 Exam'],
            ['FE02-0012', 'MD RAYHAN ALI', 'Passed in October 2023 Exam'],
            ['FE03-0011', 'MD. TANVIR RUBAYED TAUHID', 'Passed in October 2023 Exam'],
            ['FE03-0023', 'Walid Ibn Zinnah Ayon', 'Passed in October 2023 Exam'],
            ['FE04-0009', 'Avishek Roy', 'Passed in October 2023 Exam'],
            ['FE04-0010', 'MD. Mahbubur Rahman', 'Passed in October 2023 Exam'],
            ['FE04-0012', 'Anupoma Debnath', 'Passed in October 2023 Exam'],
        ];

        $afternoonExam = [
            ['FE01-0056', 'Afia Sultana Shimu', 'Passed in April 2024 Exam'],
            ['FE01-0059', 'Durjoy Kumar Sutrodhar', 'Passed in April 2024 Exam'],
            ['FE01-0060', 'Md Azman Hossain', 'Passed in April 2024 Exam'],
            ['FE01-0071', 'Nafiul Huda', 'Passed in April 2024 Exam'],
            ['FE01-0092', 'Tanzila Akter', 'Passed in April 2024 Exam'],
            ['FE01-0102', 'TAHSIN SHADMAN', 'Passed in April 2024 Exam'],
            ['FE01-0107', 'MD. Shahed Annam', 'Passed in April 2024 Exam'],
            ['FE01-0110', 'Pollob Chandra Ray', 'Passed in April 2024 Exam'],
            ['FE01-0148', 'ADIBUL HAQUE', 'Passed in April 2024 Exam'],
            ['FE01-0152', 'Hemel Sharker Akash', 'Passed in April 2024 Exam'],
            ['FE01-0157', 'Arifur Rahman', 'Passed in April 2024 Exam'],
            ['FE01-0178', 'Irtifa Haider', 'Passed in April 2024 Exam'],
            ['FE01-0179', 'Seaum Ahmed Tazim', 'Passed in April 2024 Exam'],
            ['FE01-0186', 'Mahfuza Mahnaz', 'Passed in April 2024 Exam'],
            ['FE01-0205', 'Md Nur Nobi', 'Passed in April 2024 Exam'],
            ['FE02-0001', 'LIHAN AHMED', 'Passed in April 2024 Exam'],
            ['FE02-0012', 'Md. Sumon Ali', 'Passed in April 2024 Exam'],
            ['FE02-0016', 'Md. Shahrier Mallick', 'Passed in April 2024 Exam'],
            ['FE02-0018', 'Sheikh Zubayer', 'Passed in April 2024 Exam'],
            ['FE03-0008', 'Md.Yeasin Arafat', 'Passed in April 2024 Exam'],
            ['FE03-0009', 'Priya Barua', 'Passed in April 2024 Exam'],
            ['FE03-0010', 'Shanewaz Aurnob', 'Passed in April 2024 Exam'],
            ['FE03-0013', 'Farhana Sultana Ananna', 'Passed in April 2024 Exam'],
            ['FE04-0004', 'Aciful Islam Khan Swopnile', 'Passed in April 2024 Exam'],
            ['FE04-0016', 'Atiqul Islam Atik', 'Passed in April 2024 Exam'],
            ['FE01-0025', 'Mahmud Alam', 'Passed in October 2023 Exam'],
            ['FE01-0033', 'Sabikun Nahar Zerin', 'Passed in October 2023 Exam'],
            ['FE01-0039', 'Afia Jahin', 'Passed in October 2023 Exam'],
            ['FE01-0084', 'Md. Janay Alam', 'Passed in October 2023 Exam'],
            ['FE01-0121', 'M. M. Jahid Hasan', 'Passed in October 2023 Exam'],
            ['FE01-0197', 'NISHI CHAKMA', 'Passed in October 2023 Exam'],
            ['FE01-0231', 'Md Adnan Hossain', 'Passed in October 2023 Exam'],
            ['FE01-0290', 'Mehedi Hasan', 'Passed in October 2023 Exam'],
            ['FE01-0318', 'Sadia Islam', 'Passed in October 2023 Exam'],
            ['FE01-0330', 'MD. SYMUM HOSSAIN', 'Passed in October 2023 Exam'],
            ['FE02-0010', 'Tushar Das', 'Passed in October 2023 Exam'],
            ['FE02-0025', 'MONDOL MRIDUL PROVAKAR', 'Passed in October 2023 Exam'],
            ['FE04-0004', 'CHINMOY MODAK TURJO', 'Passed in October 2023 Exam'],
            ['FE04-0005', 'Pantho Haque', 'Passed in October 2023 Exam'],
            ['FE04-0008', 'Nusrat Jahan Jonaki', 'Passed in October 2023 Exam'],
        ];

        foreach ($morningExam as [$examineeNo, $name, $remarks]) {
            $intakeName = $this->extractIntakeName($remarks);
            $intakeId = Intake::where('name', $intakeName)->value('id');

            $halfPasser = HalfPasser::firstOrCreate(
                ['examinee_no' => $examineeNo, 'type_id' => $morningTypeId],
                [
                    'name' => $name,
                    'type_id' => $morningTypeId,
                    'intake_id' => $intakeId,
                ],
            );

            if (! $halfPasser->hasStatus('active')) {
                $halfPasser->setStatus('active');
            }
        }

        foreach ($afternoonExam as [$examineeNo, $name, $remarks]) {
            $intakeName = $this->extractIntakeName($remarks);
            $intakeId = Intake::where('name', $intakeName)->value('id');

            $halfPasser = HalfPasser::firstOrCreate(
                ['examinee_no' => $examineeNo, 'type_id' => $afternoonTypeId],
                [
                    'name' => $name,
                    'type_id' => $afternoonTypeId,
                    'intake_id' => $intakeId,
                ],
            );

            if (! $halfPasser->hasStatus('active')) {
                $halfPasser->setStatus('active');
            }
        }
    }

    private function extractIntakeName(string $remarks): string
    {
        return str_replace(['Passed in ', ' Exam'], '', $remarks);
    }
}
