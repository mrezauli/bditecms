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
            ['name' => 'Islamic University of Technology (IUT), Gazipur'],
            [
                'acronym' => 'IUT',
                'website' => 'https://www.iutoic-dhaka.edu',
                'university_category_id' => $categories['International'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Asian University for Women'],
            [
                'acronym' => null,
                'website' => 'https://www.auw.edu.bd',
                'university_category_id' => $categories['International'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'South Asian University'],
            [
                'acronym' => null,
                'website' => 'https://www.southasianuniversity.org',
                'university_category_id' => $categories['International'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Dhaka'],
            [
                'acronym' => null,
                'website' => 'https://www.du.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Rajshahi'],
            [
                'acronym' => null,
                'website' => 'https://www.ru.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Agricultural University'],
            [
                'acronym' => null,
                'website' => 'https://www.bau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Engineering & Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.buet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Chittagong'],
            [
                'acronym' => null,
                'website' => 'https://www.cu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Jahangirnagar University'],
            [
                'acronym' => null,
                'website' => 'https://www.juniv.edu',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Islamic University, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.iu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Shahjalal University of Science & Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.sust.edu',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Khulna University'],
            [
                'acronym' => null,
                'website' => 'https://www.ku.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'National University'],
            [
                'acronym' => null,
                'website' => 'https://www.nu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Open University'],
            [
                'acronym' => null,
                'website' => 'https://www.bou.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Medical University'],
            [
                'acronym' => null,
                'website' => 'https://www.bsmmu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Gazipur Agricultural University'],
            [
                'acronym' => null,
                'website' => 'https://gau.edu.bd/',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Hajee Mohammad Danesh Science & Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.hstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Mawlana Bhashani Science & Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.mbstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Patuakhali Science And Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.pstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Sher-e-Bangla Agricultural University'],
            [
                'acronym' => null,
                'website' => 'https://www.sau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Chittagong University of Engineering & Technology (CUET)'],
            [
                'acronym' => 'CUET',
                'website' => 'https://www.cuet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Rajshahi University of Engineering & Technology (RUET)'],
            [
                'acronym' => 'RUET',
                'website' => 'https://www.ruet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Khulna University of Engineering & Technology (KUET)'],
            [
                'acronym' => 'KUET',
                'website' => 'https://www.kuet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Dhaka University of Engineering & Technology (DUET)'],
            [
                'acronym' => 'DUET',
                'website' => 'https://www.duet.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Noakhali Science & Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.nstu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Jagannath University'],
            [
                'acronym' => null,
                'website' => 'https://www.jnu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Comilla University'],
            [
                'acronym' => null,
                'website' => 'https://www.cou.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Jatiya Kabi Kazi Nazrul Islam University'],
            [
                'acronym' => null,
                'website' => 'https://www.jkkniu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Chittagong Veterinary and Animal Sciences University'],
            [
                'acronym' => null,
                'website' => 'https://www.cvasu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Sylhet Agricultural University'],
            [
                'acronym' => null,
                'website' => 'https://www.sau.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Jessore University of Science & Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.just.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Pabna University of Science and Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.pust.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Begum Rokeya University, Rangpur'],
            [
                'acronym' => null,
                'website' => 'https://www.brur.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Professionals'],
            [
                'acronym' => null,
                'website' => 'https://www.bup.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Gopalganj Science & Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.bsmrstu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Textiles'],
            [
                'acronym' => null,
                'website' => 'https://www.butex.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Barishal'],
            [
                'acronym' => null,
                'website' => 'https://www.bu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Rangamati Science and Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.rmstu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Maritime University'],
            [
                'acronym' => null,
                'website' => 'https://bmu.edu.bd/',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Islamic Arabic University'],
            [
                'acronym' => null,
                'website' => 'https://www.iau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Chittagong Medical University'],
            [
                'acronym' => null,
                'website' => 'https://www.cmu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Rajshahi Medical University'],
            [
                'acronym' => null,
                'website' => 'https://www.rmu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Rabindra University, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.rub.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Frontier Technology, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.uftb.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Netrokona University'],
            [
                'acronym' => null,
                'website' => 'https://www.shu.edu.bd/',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Khulna Agricultural University'],
            [
                'acronym' => null,
                'website' => 'https://www.kau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Jamalpur Science and Technology University'],
            [
                'acronym' => null,
                'website' => 'https://bsfmstu.ac.bd/',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Sylhet Medical University, Sylhet'],
            [
                'acronym' => null,
                'website' => 'https://www.bsfmmu.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Aviation And Aerospace University, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.aaub.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Chandpur Science and Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.cstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Kishoreganj University'],
            [
                'acronym' => null,
                'website' => 'https://bsmru.ac.bd.',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Hobiganj Agricultural University'],
            [
                'acronym' => null,
                'website' => 'https://www.hau.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Khulna Medical University, Khulna'],
            [
                'acronym' => null,
                'website' => 'https://www.shmu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Kurigram Agricultural University'],
            [
                'acronym' => null,
                'website' => 'https://www.kuriau.edu.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Sunamganj Science and Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.sstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Pirojpur Science & Technology University'],
            [
                'acronym' => null,
                'website' => 'https://www.prstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Naogaon University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Meherpur University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bogra Science and Technology University'],
            [
                'acronym' => null,
                'website' => 'https://bstu.ac.bd',
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Dhaka Central University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Thakurgaon University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Lakshmipur Science & Technology University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Public'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'North South University'],
            [
                'acronym' => null,
                'website' => 'https://www.northsouth.edu',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Science & Technology Chittagong'],
            [
                'acronym' => null,
                'website' => 'https://www.ustc.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Independent University, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.iub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Central Women\'s University'],
            [
                'acronym' => null,
                'website' => 'https://www.cwu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'International University of Business Agriculture & Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.iubat.edu',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'International Islamic University Chittagong'],
            [
                'acronym' => null,
                'website' => 'https://www.iiuc.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Ahsanullah University of Science and Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.aust.edu',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'American International University-Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.aiub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'East West University'],
            [
                'acronym' => null,
                'website' => 'https://www.ewubd.edu',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Asia Pacific'],
            [
                'acronym' => null,
                'website' => 'https://www.uap-bd.edu',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Gono Bishwabidyalay'],
            [
                'acronym' => null,
                'website' => 'https://www.gonouniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'The People\'s University of Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.pub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Asian University of Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.aub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Dhaka International University'],
            [
                'acronym' => null,
                'website' => 'https://www.diu.ac',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Manarat International University'],
            [
                'acronym' => null,
                'website' => 'https://www.manarat.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'BRAC University'],
            [
                'acronym' => null,
                'website' => 'https://www.bracu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh University'],
            [
                'acronym' => null,
                'website' => 'https://www.bu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Leading University'],
            [
                'acronym' => null,
                'website' => 'https://www.lus.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'BGC Trust University Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.bgctub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Sylhet International University'],
            [
                'acronym' => null,
                'website' => 'https://www.siu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Development Alternative'],
            [
                'acronym' => null,
                'website' => 'https://www.uoda.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Premier University'],
            [
                'acronym' => null,
                'website' => 'https://www.puc.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Southeast University'],
            [
                'acronym' => null,
                'website' => 'https://www.seu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Daffodil International University'],
            [
                'acronym' => null,
                'website' => 'https://www.daffodilvarsity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Stamford University Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.stamforduniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'State University of Bangladesh (SUB)'],
            [
                'acronym' => 'SUB',
                'website' => 'https://www.sub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'City University'],
            [
                'acronym' => null,
                'website' => 'https://www.cityuniversity.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Prime University'],
            [
                'acronym' => null,
                'website' => 'https://www.primeuniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Northern University Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.nub.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Southern University Bangladesh'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Green University of Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.green.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Pundra University of Science & Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.pundrauniversity.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'World University of Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.wub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Shanto-Mariam University of Creative Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.smuct.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'The Millennium University'],
            [
                'acronym' => null,
                'website' => 'https://www.themillenniumuniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Eastern University'],
            [
                'acronym' => null,
                'website' => 'https://www.easternuni.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Metropolitan University'],
            [
                'acronym' => null,
                'website' => 'https://www.metrouni.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Uttara University'],
            [
                'acronym' => null,
                'website' => 'https://www.uttarauniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'United International University'],
            [
                'acronym' => null,
                'website' => 'https://www.uiu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of South Asia'],
            [
                'acronym' => null,
                'website' => 'https://www.southasiauni.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Victoria University of Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.vub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Business & Technology (BUBT)'],
            [
                'acronym' => 'BUBT',
                'website' => 'https://www.bubt.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Presidency University'],
            [
                'acronym' => null,
                'website' => 'https://www.presidency.edu.bd, www.pu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Information Technology & Sciences'],
            [
                'acronym' => null,
                'website' => 'https://www.uits.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Primeasia University'],
            [
                'acronym' => null,
                'website' => 'https://www.primeasia.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Royal University of Dhaka'],
            [
                'acronym' => null,
                'website' => 'https://www.royal.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Liberal Arts Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.ulab.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Atish Dipankar University of Science & Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.adust.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Islami University'],
            [
                'acronym' => null,
                'website' => 'https://www.biu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'ASA University Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.asaub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'East Delta University'],
            [
                'acronym' => null,
                'website' => 'https://www.eastdelta.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'European University of Bangladesh'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Varendra University'],
            [
                'acronym' => null,
                'website' => 'https://www.vu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Hamdard University Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.hamdarduniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'BGMEA University of Fashion & Technology(BUFT)'],
            [
                'acronym' => 'BUFT',
                'website' => 'https://www.buft.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'North East University Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.neub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'First Capital University of Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.fcub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Ishakha International University, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.ishakha.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Z.H Sikder University of Science & Technology'],
            [
                'acronym' => null,
                'website' => 'https://www. zhsust.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Exim Bank Agricultural University, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.ebaub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'North Western University'],
            [
                'acronym' => null,
                'website' => 'https://www.nwu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Khwaja Yunus Ali University'],
            [
                'acronym' => null,
                'website' => 'https://www.kyau.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Sonargaon University'],
            [
                'acronym' => null,
                'website' => 'https://www.su.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Feni University'],
            [
                'acronym' => null,
                'website' => 'https://www.feniuniversity.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Britannia University'],
            [
                'acronym' => null,
                'website' => 'https://www.britannia.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Port City International University'],
            [
                'acronym' => null,
                'website' => 'https://www.portcity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh University of Health Sciences'],
            [
                'acronym' => null,
                'website' => 'https://www.buhs.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Chittagong Independent University'],
            [
                'acronym' => null,
                'website' => 'https://www.ciu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Notre Dame University Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.ndub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Times University, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'http://www.timesuniversitybd.com',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'North Bengal International University'],
            [
                'acronym' => null,
                'website' => 'https://www.nbiu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Fareast International University'],
            [
                'acronym' => null,
                'website' => 'https://www.fiu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Rajshahi Science & Technology University (RSTU), Natore'],
            [
                'acronym' => 'RSTU',
                'website' => 'https://www.rstu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Brahmaputra International University'],
            [
                'acronym' => null,
                'website' => 'https://www.sfmu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Cox\'s Bazar International University'],
            [
                'acronym' => null,
                'website' => 'https://www.cbiu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'R. P. Shaha University'],
            [
                'acronym' => null,
                'website' => 'https://www.rpsu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'German University Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.gub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Global University Bangladesh'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'CCN University of Science & Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.ccnust.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Army University of Science and Technology (BAUST), Saidpur'],
            [
                'acronym' => 'BAUST',
                'website' => 'https://www.baust.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Army University of Engineering and Technology (BAUET), Qadirabad'],
            [
                'acronym' => 'BAUET',
                'website' => 'https://www.bauet.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Army International University of Science & Technology(BAIUST) ,Comilla'],
            [
                'acronym' => 'BAIUST',
                'website' => 'https://www.baiust.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Scholars'],
            [
                'acronym' => null,
                'website' => 'https://www.ius.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Canadian University of Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.cub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'N.P.I University of Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.npiub.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Northern University of Business & Technology, Khulna'],
            [
                'acronym' => null,
                'website' => 'https://www.nubtkhulna.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Rabindra Maitree University, Kushtia'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Creative Technology, Chittagong'],
            [
                'acronym' => null,
                'website' => 'https://www.uctc.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Central University of Science and Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.cust.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Tagore University of Creative Arts, Uttara, Dhaka, Bangladesh'],
            [
                'acronym' => null,
                'website' => 'https://www.tuca.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Global Village'],
            [
                'acronym' => null,
                'website' => 'https://www.ugv.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Rupayan A.K.M Shamsuzzoha University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Anwer Khan Modern University'],
            [
                'acronym' => null,
                'website' => 'https://www.akmu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'ZNRF University of Management Sciences'],
            [
                'acronym' => null,
                'website' => 'https://www.zums.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Ahsania Mission University of Science and Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.amust.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Khulna Khan Bahadur Ahsanullah University'],
            [
                'acronym' => null,
                'website' => 'https://www.kkbau.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bandarban University'],
            [
                'acronym' => null,
                'website' => 'https://www.bubban.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Shah Makhdum Management University, Rajshahi'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Trust University, Barishal'],
            [
                'acronym' => null,
                'website' => 'https://www.trustuniversity.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'International Standard University'],
            [
                'acronym' => null,
                'website' => 'https://www.isu.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Brahmanbaria'],
            [
                'acronym' => null,
                'website' => 'https://www.uob.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'University of Skill Enrichment and Technology'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Microland University of Science and Technology'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'R.T.M Al-Kabir Technical University'],
            [
                'acronym' => null,
                'website' => 'https://www.rtm-aktu.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Dr. Momtaz Begum University of Science and Technology (MUST)'],
            [
                'acronym' => 'MUST',
                'website' => 'https://www.must.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Chattogram BGMEA University of Fashion and Technology'],
            [
                'acronym' => null,
                'website' => 'https://www.cbuft.edu.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Bangladesh Army University of Science and Technology, Khulna'],
            [
                'acronym' => null,
                'website' => 'https://www.baustkhulna.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Teesta University, Rangpur'],
            [
                'acronym' => null,
                'website' => 'https://www.teestauniversity.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'International Islami University of Science and Technology Bangladesh (IIUSTB)'],
            [
                'acronym' => 'IIUSTB',
                'website' => 'https://www.iiustb.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Lalon University of Science and Arts'],
            [
                'acronym' => null,
                'website' => 'https://lusa.ac.bd',
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Justice Abu Zafar Siddiquie Science and Technology University, Kustia'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Grameen University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'IBAIS University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'The University of Comilla'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'Queens University'],
            [
                'acronym' => null,
                'website' => null,
                'university_category_id' => $categories['Private'],
            ],
        );
        University::firstOrCreate(
            ['name' => 'America Bangladesh University'],
            [
                'acronym' => null,
                'website' => 'https://.',
                'university_category_id' => $categories['Private'],
            ],
        );
    }
}
