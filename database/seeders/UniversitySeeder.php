<?php

namespace Database\Seeders;

use App\Models\University;
use App\Models\UniversityCategory;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    public function run(): void
    {
        $categories = UniversityCategory::pluck('id', 'name');

        University::firstOrCreate(
            ['name' => 'Islamic University of Technology, Gazipur'],
            [
                'acronym' => 'IUT',
                'website' => 'https://www.iutoic-dhaka.edu',
                'university_category_id' => $categories['International'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Asian University for Women'],
            [
                'acronym' => 'AUW',
                'website' => 'https://www.auw.edu.bd',
                'university_category_id' => $categories['International'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'South Asian University'],
            [
                'acronym' => 'SAU',
                'website' => 'https://www.southasianuniversity.org',
                'university_category_id' => $categories['International'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Dhaka'],
            [
                'acronym' => 'DU',
                'website' => 'https://www.du.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Rajshahi'],
            [
                'acronym' => 'RU',
                'website' => 'https://www.ru.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Agricultural University'],
            [
                'acronym' => 'BAU',
                'website' => 'https://www.bau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Engineering & Technology'],
            [
                'acronym' => 'BUET',
                'website' => 'https://www.buet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Chittagong'],
            [
                'acronym' => 'CU',
                'website' => 'https://www.cu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Jahangirnagar University'],
            [
                'acronym' => 'JU',
                'website' => 'https://www.juniv.edu',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Islamic University, Bangladesh'],
            [
                'acronym' => 'IU',
                'website' => 'https://www.iu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Shahjalal University of Science & Technology'],
            [
                'acronym' => 'SUST',
                'website' => 'https://www.sust.edu',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Khulna University'],
            [
                'acronym' => 'KU',
                'website' => 'https://www.ku.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'National University'],
            [
                'acronym' => 'NU',
                'website' => 'https://www.nu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Open University'],
            [
                'acronym' => 'BOU',
                'website' => 'https://www.bou.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Medical University'],
            [
                'acronym' => 'BMU',
                'website' => 'https://www.bmu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Gazipur Agricultural University'],
            [
                'acronym' => 'GAU',
                'website' => 'https://gau.edu.bd/',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Hajee Mohammad Danesh Science & Technology University'],
            [
                'acronym' => 'HSTU',
                'website' => 'https://www.hstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Mawlana Bhashani Science & Technology University'],
            [
                'acronym' => 'MBSTU',
                'website' => 'https://www.mbstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Patuakhali Science And Technology University'],
            [
                'acronym' => 'PSTU',
                'website' => 'https://www.pstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Sher-e-Bangla Agricultural University'],
            [
                'acronym' => 'SAU',
                'website' => 'https://www.sau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Chittagong University of Engineering & Technology'],
            [
                'acronym' => 'CUET',
                'website' => 'https://www.cuet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Rajshahi University of Engineering & Technology'],
            [
                'acronym' => 'RUET',
                'website' => 'https://www.ruet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Khulna University of Engineering & Technology'],
            [
                'acronym' => 'KUET',
                'website' => 'https://www.kuet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Dhaka University of Engineering & Technology'],
            [
                'acronym' => 'DUET',
                'website' => 'https://www.duet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Noakhali Science & Technology University'],
            [
                'acronym' => 'NSTU',
                'website' => 'https://www.nstu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Jagannath University'],
            [
                'acronym' => 'JNU',
                'website' => 'https://www.jnu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Comilla University'],
            [
                'acronym' => 'COU',
                'website' => 'https://www.cou.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Jatiya Kabi Kazi Nazrul Islam University'],
            [
                'acronym' => 'JKKNIU',
                'website' => 'https://www.jkkniu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Chittagong Veterinary and Animal Sciences University'],
            [
                'acronym' => 'CVASU',
                'website' => 'https://www.cvasu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Sylhet Agricultural University'],
            [
                'acronym' => 'SAU',
                'website' => 'https://www.sau.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Jessore University of Science & Technology'],
            [
                'acronym' => 'JUST',
                'website' => 'https://www.just.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Pabna University of Science and Technology'],
            [
                'acronym' => 'PUST',
                'website' => 'https://www.pust.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Begum Rokeya University, Rangpur'],
            [
                'acronym' => 'BRUR',
                'website' => 'https://www.brur.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Professionals'],
            [
                'acronym' => 'BUP',
                'website' => 'https://www.bup.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Gopalganj Science & Technology University'],
            [
                'acronym' => 'GSTU',
                'website' => 'https://www.gstu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Textiles'],
            [
                'acronym' => 'BUTEX',
                'website' => 'https://www.butex.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Barishal'],
            [
                'acronym' => 'BU',
                'website' => 'https://www.bu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Rangamati Science and Technology University'],
            [
                'acronym' => 'RMSTU',
                'website' => 'https://www.rmstu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Maritime University'],
            [
                'acronym' => 'BMU',
                'website' => 'https://bmu.edu.bd/',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Islamic Arabic University'],
            [
                'acronym' => 'IAU',
                'website' => 'https://www.iau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Chittagong Medical University'],
            [
                'acronym' => 'CMU',
                'website' => 'https://www.cmu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Rajshahi Medical University'],
            [
                'acronym' => 'RMU',
                'website' => 'https://www.rmu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Rabindra University, Bangladesh'],
            [
                'acronym' => 'RUB',
                'website' => 'https://www.rub.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Frontier Technology, Bangladesh'],
            [
                'acronym' => 'UFTB',
                'website' => 'https://www.uftb.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Netrokona University'],
            [
                'acronym' => 'NEU',
                'website' => 'https://www.neu.ac.bd/',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Khulna Agricultural University'],
            [
                'acronym' => 'KAU',
                'website' => 'https://www.kau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Jamalpur Science and Technology University'],
            [
                'acronym' => 'JSTU',
                'website' => 'https://jstu.ac.bd/',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Sylhet Medical University, Sylhet'],
            [
                'acronym' => 'SMU',
                'website' => 'https://www.smu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Aviation And Aerospace University, Bangladesh'],
            [
                'acronym' => 'AAUB',
                'website' => 'https://www.aaub.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Chandpur Science and Technology University'],
            [
                'acronym' => 'CSTU',
                'website' => 'https://www.cstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Kishoreganj University'],
            [
                'acronym' => 'KiU',
                'website' => 'https://kiu.ac.bd.',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Hobiganj Agricultural University'],
            [
                'acronym' => 'HAU',
                'website' => 'https://www.hau.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Khulna Medical University, Khulna'],
            [
                'acronym' => 'KMU',
                'website' => 'https://www.kmu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Kurigram Agricultural University'],
            [
                'acronym' => 'KURIAU',
                'website' => 'https://www.kuriau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Sunamganj Science and Technology University'],
            [
                'acronym' => 'SSTU',
                'website' => 'https://www.sstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Pirojpur Science & Technology University'],
            [
                'acronym' => 'PRSTU',
                'website' => 'https://www.prstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Naogaon University'],
            [
                'acronym' => 'NAU',
                'website' => 'https://www.nau.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Meherpur University'],
            [
                'acronym' => 'MUM',
                'website' => 'https://www.mum.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bogra Science and Technology University'],
            [
                'acronym' => 'BSTU',
                'website' => 'https://bstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Dhaka Central University'],
            [
                'acronym' => 'DCU',
                'website' => 'https://www.dcu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Thakurgaon University'],
            [
                'acronym' => 'TU',
                'website' => null,
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Lakshmipur Science & Technology University'],
            [
                'acronym' => 'LSTU',
                'website' => null,
                'university_category_id' => $categories['Public'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'North South University'],
            [
                'acronym' => 'NSU',
                'website' => 'https://www.northsouth.edu',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Science & Technology Chittagong'],
            [
                'acronym' => 'USTC',
                'website' => 'https://www.ustc.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Independent University, Bangladesh'],
            [
                'acronym' => 'IUB',
                'website' => 'https://www.iub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Central Women\'s University'],
            [
                'acronym' => 'CWU',
                'website' => 'https://www.cwu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'International University of Business Agriculture & Technology'],
            [
                'acronym' => 'IUBAT',
                'website' => 'https://www.iubat.edu',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'International Islamic University Chittagong'],
            [
                'acronym' => 'IIUC',
                'website' => 'https://www.iiuc.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Ahsanullah University of Science and Technology'],
            [
                'acronym' => 'AUST',
                'website' => 'https://www.aust.edu',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'American International University-Bangladesh'],
            [
                'acronym' => 'AIUB',
                'website' => 'https://www.aiub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'East West University'],
            [
                'acronym' => 'EWU',
                'website' => 'https://www.ewubd.edu',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Asia Pacific'],
            [
                'acronym' => 'UAP',
                'website' => 'https://www.uap-bd.edu',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Gono Bishwabidyalay'],
            [
                'acronym' => 'GB',
                'website' => 'https://www.gonouniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'The People\'s University of Bangladesh'],
            [
                'acronym' => 'PUB',
                'website' => 'https://www.pub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Asian University of Bangladesh'],
            [
                'acronym' => 'AUB',
                'website' => 'https://www.aub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Dhaka International University'],
            [
                'acronym' => 'DIU',
                'website' => 'https://www.diu.ac',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Manarat International University'],
            [
                'acronym' => 'MIU',
                'website' => 'https://www.manarat.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'BRAC University'],
            [
                'acronym' => 'BRACU',
                'website' => 'https://www.bracu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh University'],
            [
                'acronym' => 'BU',
                'website' => 'https://www.bu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Leading University'],
            [
                'acronym' => 'LUS',
                'website' => 'https://www.lus.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'BGC Trust University Bangladesh'],
            [
                'acronym' => 'BGCTUB',
                'website' => 'https://www.bgctub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Sylhet International University'],
            [
                'acronym' => 'SIU',
                'website' => 'https://www.siu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Development Alternative'],
            [
                'acronym' => 'UODA',
                'website' => 'https://www.uoda.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Premier University'],
            [
                'acronym' => 'PUC',
                'website' => 'https://www.puc.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Southeast University'],
            [
                'acronym' => 'SEU',
                'website' => 'https://www.seu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Daffodil International University'],
            [
                'acronym' => 'DIU',
                'website' => 'https://www.daffodilvarsity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Stamford University Bangladesh'],
            [
                'acronym' => 'SUB',
                'website' => 'https://www.stamforduniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'State University of Bangladesh'],
            [
                'acronym' => 'SUB',
                'website' => 'https://www.sub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'City University'],
            [
                'acronym' => 'CU',
                'website' => 'https://www.cityuniversity.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Prime University'],
            [
                'acronym' => 'PU',
                'website' => 'https://www.primeuniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Northern University Bangladesh'],
            [
                'acronym' => 'NUB',
                'website' => 'https://www.nub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Southern University Bangladesh'],
            [
                'acronym' => 'SUB',
                'website' => 'https://www.southern.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Green University of Bangladesh'],
            [
                'acronym' => 'GUB',
                'website' => 'https://www.green.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Pundra University of Science & Technology'],
            [
                'acronym' => 'PUST',
                'website' => 'https://www.pundrauniversity.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'World University of Bangladesh'],
            [
                'acronym' => 'WUB',
                'website' => 'https://www.wub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Shanto-Mariam University of Creative Technology'],
            [
                'acronym' => 'SMUCT',
                'website' => 'https://www.smuct.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'The Millennium University'],
            [
                'acronym' => 'TMU',
                'website' => 'https://www.themillenniumuniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Eastern University'],
            [
                'acronym' => 'EU',
                'website' => 'https://www.easternuni.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Metropolitan University'],
            [
                'acronym' => 'MU',
                'website' => 'https://www.metrouni.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Uttara University'],
            [
                'acronym' => 'UU',
                'website' => 'https://www.uttarauniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'United International University'],
            [
                'acronym' => 'UIU',
                'website' => 'https://www.uiu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of South Asia'],
            [
                'acronym' => 'USA',
                'website' => 'https://www.southasiauni.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Victoria University of Bangladesh'],
            [
                'acronym' => 'VUB',
                'website' => 'https://www.vub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Business & Technology'],
            [
                'acronym' => 'BUBT',
                'website' => 'https://www.bubt.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Presidency University'],
            [
                'acronym' => 'PU',
                'website' => 'https://www.presidency.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Information Technology & Sciences'],
            [
                'acronym' => 'UITS',
                'website' => 'https://www.uits.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Primeasia University'],
            [
                'acronym' => 'PU',
                'website' => 'https://www.primeasia.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Royal University of Dhaka'],
            [
                'acronym' => 'RUD',
                'website' => 'https://www.royal.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Liberal Arts Bangladesh'],
            [
                'acronym' => 'ULAB',
                'website' => 'https://www.ulab.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Atish Dipankar University of Science & Technology'],
            [
                'acronym' => 'ADUST',
                'website' => 'https://www.adust.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Islami University'],
            [
                'acronym' => 'BIU',
                'website' => 'https://www.biu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'ASA University Bangladesh'],
            [
                'acronym' => 'ASAUB',
                'website' => 'https://www.asaub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'East Delta University'],
            [
                'acronym' => 'EDU',
                'website' => 'https://www.eastdelta.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'European University of Bangladesh'],
            [
                'acronym' => 'EUB',
                'website' => 'https://www.eub.edu',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Varendra University'],
            [
                'acronym' => 'VU',
                'website' => 'https://www.vu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Hamdard University Bangladesh'],
            [
                'acronym' => 'HUB',
                'website' => 'https://www.hamdarduniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'BGMEA University of Fashion & Technology'],
            [
                'acronym' => 'BUFT',
                'website' => 'https://www.buft.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'North East University Bangladesh'],
            [
                'acronym' => 'NEUB',
                'website' => 'https://www.neub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'First Capital University of Bangladesh'],
            [
                'acronym' => 'FCUB',
                'website' => 'https://www.fcub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Ishakha International University, Bangladesh'],
            [
                'acronym' => 'IIUB',
                'website' => 'https://www.ishakha.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Z.H Sikder University of Science & Technology'],
            [
                'acronym' => 'ZHSUST',
                'website' => 'https://www.zhsust.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Exim Bank Agricultural University, Bangladesh'],
            [
                'acronym' => 'EBAUB',
                'website' => 'https://www.ebaub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'North Western University'],
            [
                'acronym' => 'NWU',
                'website' => 'https://www.nwu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Khwaja Yunus Ali University'],
            [
                'acronym' => 'KYAU',
                'website' => 'https://www.kyau.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Sonargaon University'],
            [
                'acronym' => 'SU',
                'website' => 'https://www.su.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Feni University'],
            [
                'acronym' => 'FU',
                'website' => 'https://www.feniuniversity.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Britannia University'],
            [
                'acronym' => 'BU',
                'website' => 'https://www.britannia.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Port City International University'],
            [
                'acronym' => 'PCIU',
                'website' => 'https://www.portcity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Health Sciences'],
            [
                'acronym' => 'BUHS',
                'website' => 'https://www.buhs.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Chittagong Independent University'],
            [
                'acronym' => 'CIU',
                'website' => 'https://www.ciu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Notre Dame University Bangladesh'],
            [
                'acronym' => 'NDUB',
                'website' => 'https://www.ndub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Times University, Bangladesh'],
            [
                'acronym' => 'TUB',
                'website' => 'http://www.timesuniversitybd.com',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'North Bengal International University'],
            [
                'acronym' => 'NBIU',
                'website' => 'https://www.nbiu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Fareast International University'],
            [
                'acronym' => 'FIU',
                'website' => 'https://www.fiu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Rajshahi Science & Technology University, Natore'],
            [
                'acronym' => 'RSTU',
                'website' => 'https://www.rstu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Brahmaputra International University'],
            [
                'acronym' => 'BRIU',
                'website' => 'https://www.briu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Cox\'s Bazar International University'],
            [
                'acronym' => 'CBIU',
                'website' => 'https://www.cbiu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'R. P. Shaha University'],
            [
                'acronym' => 'RPSU',
                'website' => 'https://www.rpsu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'German University Bangladesh'],
            [
                'acronym' => 'GUB',
                'website' => 'https://www.gub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Global University Bangladesh'],
            [
                'acronym' => 'GUB',
                'website' => 'https://globaluniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'CCN University of Science & Technology'],
            [
                'acronym' => 'CCNUST',
                'website' => 'https://www.ccnust.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Army University of Science and Technology, Saidpur'],
            [
                'acronym' => 'BAUST',
                'website' => 'https://www.baust.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Army University of Engineering and Technology, Qadirabad'],
            [
                'acronym' => 'BAUET',
                'website' => 'https://www.bauet.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Army International University of Science & Technology,Comilla'],
            [
                'acronym' => 'BAIUST',
                'website' => 'https://www.baiust.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Scholars'],
            [
                'acronym' => 'IUS',
                'website' => 'https://www.ius.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Canadian University of Bangladesh'],
            [
                'acronym' => 'CUB',
                'website' => 'https://www.cub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'N.P.I University of Bangladesh'],
            [
                'acronym' => 'NPIUB',
                'website' => 'https://www.npiub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Northern University of Business & Technology, Khulna'],
            [
                'acronym' => 'NUBTK',
                'website' => 'https://www.nubtkhulna.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Rabindra Maitree University, Kushtia'],
            [
                'acronym' => 'RMU',
                'website' => 'https://www.rmu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Creative Technology, Chittagong'],
            [
                'acronym' => 'UCTC',
                'website' => 'https://www.uctc.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Central University of Science and Technology'],
            [
                'acronym' => 'CUST',
                'website' => 'https://www.cust.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Tagore University of Creative Arts, Uttara, Dhaka, Bangladesh'],
            [
                'acronym' => 'TUCA',
                'website' => 'https://www.tuca.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Global Village'],
            [
                'acronym' => 'UGV',
                'website' => 'https://www.ugv.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Rupayan A.K.M Shamsuzzoha University'],
            [
                'acronym' => 'RAKMSU',
                'website' => 'https://www.rakmsu-ac-bd.org',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Anwer Khan Modern University'],
            [
                'acronym' => 'AKMU',
                'website' => 'https://www.akmu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'ZNRF University of Management Sciences'],
            [
                'acronym' => 'ZUMS',
                'website' => 'https://www.zums.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Ahsania Mission University of Science and Technology'],
            [
                'acronym' => 'AMUST',
                'website' => 'https://www.amust.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Khulna Khan Bahadur Ahsanullah University'],
            [
                'acronym' => 'KKBAU',
                'website' => 'https://www.kkbau.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bandarban University'],
            [
                'acronym' => 'BUBBAN',
                'website' => 'https://www.bubban.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Shah Makhdum Management University, Rajshahi'],
            [
                'acronym' => 'SMMU',
                'website' => 'https://smmuniversity.ac/',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Trust University, Barishal'],
            [
                'acronym' => 'TU',
                'website' => 'https://www.trustuniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'International Standard University'],
            [
                'acronym' => 'ISU',
                'website' => 'https://www.isu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Brahmanbaria'],
            [
                'acronym' => 'UoB',
                'website' => 'https://www.uob.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'University of Skill Enrichment and Technology'],
            [
                'acronym' => 'USET',
                'website' => 'https://www.uset.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Microland University of Science and Technology'],
            [
                'acronym' => 'MUST',
                'website' => 'https://www.microlanduniversity.org/',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'R.T.M Al-Kabir Technical University'],
            [
                'acronym' => 'RTMAKTU',
                'website' => 'https://www.rtm-aktu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Dr. Momtaz Begum University of Science and Technology'],
            [
                'acronym' => 'MUST',
                'website' => 'https://www.must.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Chattogram BGMEA University of Fashion and Technology'],
            [
                'acronym' => 'CBUFT',
                'website' => 'https://www.cbuft.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Bangladesh Army University of Science and Technology, Khulna'],
            [
                'acronym' => 'BAUSTK',
                'website' => 'https://www.baustkhulna.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Teesta University, Rangpur'],
            [
                'acronym' => 'TU',
                'website' => 'https://www.teestauniversity.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'International Islami University of Science and Technology Bangladesh'],
            [
                'acronym' => 'IIUSTB',
                'website' => 'https://www.iiustb.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Lalon University of Science and Arts'],
            [
                'acronym' => 'LUSA',
                'website' => 'https://lusa.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Justice Abu Zafar Siddiquie Science and Technology University, Kustia'],
            [
                'acronym' => 'JAZSSTUK',
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Grameen University'],
            [
                'acronym' => 'GU',
                'website' => 'https://grameenu.ac',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'IBAIS University'],
            [
                'acronym' => 'IBAISU',
                'website' => 'https://ibaisuniversity.org',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'The University of Comilla'],
            [
                'acronym' => 'TUC',
                'website' => 'https://unicedu.ac',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'Queens University'],
            [
                'acronym' => 'QU',
                'website' => 'https://www.queensuniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');
        University::firstOrCreate(
            ['name' => 'America Bangladesh University'],
            [
                'acronym' => 'ABU',
                'website' => 'https://www.abu.ac',
                'university_category_id' => $categories['Private'],
            ],
        )->setStatus('active');

        University::firstOrCreate(
            ['name' => 'Not Listed?'],
            [
                'acronym' => 'OTHER',
                'website' => null,
                'university_category_id' => null,
            ],
        )->setStatus('active');
    }
}
