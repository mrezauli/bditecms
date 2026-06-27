<?php

use App\Models\Answer;
use App\Models\District;
use App\Models\Division;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\Question;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use App\Models\UniversityCategory;
use Laravel\Fortify\Features;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    $exam = Exam::factory()->create();
    $type = Type::factory()->create(['exam_id' => $exam->id]);
    $site = Site::factory()->create();
    $division = Division::factory()->create();
    $district = District::factory()->create(['division_id' => $division->id]);
    $universityCategory = UniversityCategory::factory()->create();
    $university = University::factory()->create(['university_category_id' => $universityCategory->id]);
    $gender = Gender::factory()->create();

    $questions = Question::factory(9)->create();
    $answerIds = [];
    foreach ($questions as $question) {
        $answer = Answer::factory()->create(['question_id' => $question->id]);
        $answerIds[] = $answer->id;
    }

    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'exam_id' => $exam->id,
        'type_id' => $type->id,
        'site_id' => $site->id,
        'first_answer_id' => $answerIds[0],
        'second_answer_id' => $answerIds[1],
        'third_answer_id' => $answerIds[2],
        'fourth_answer_id' => $answerIds[3],
        'fifth_answer_id' => $answerIds[4],
        'sixth_answer_id' => $answerIds[5],
        'seventh_answer_id' => $answerIds[6],
        'eighth_answer_id' => $answerIds[7],
        'ninth_answer_id' => $answerIds[8],
        'date_of_birth' => '2000-01-15',
        'gender_id' => $gender->id,
        'occupation' => 'Engineer',
        'mobile_number' => '01712345678',
        'present_address' => '123 Main Street',
        'work_address' => '456 Office Road',
        'post_code' => '1205',
        'district_id' => $district->id,
        'university_id' => $university->id,
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', ['name' => 'John Doe', 'email' => 'test@example.com']);
    $this->assertDatabaseHas('profiles', ['user_id' => auth()->id()]);
    $this->assertDatabaseHas('enrollments', ['exam_id' => $exam->id]);
});
