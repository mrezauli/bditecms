<?php

use App\Models\Answer;
use App\Models\District;
use App\Models\Division;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\HalfPasser;
use App\Models\Intake;
use App\Models\Question;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use App\Models\UniversityCategory;
use App\Models\User;
use Laravel\Fortify\Features;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

function seedRegistrationContext(): array
{
    $exam = Exam::factory()->create(['acronym' => 'XX']);

    $intake = Intake::factory()->for($exam)->create([
        'registration_starts_at' => now()->subDay(),
        'registration_ends_at' => now()->addDays(30),
        'result_published_at' => null,
    ]);
    $intake->setStatus('active');

    return [
        'exam' => $exam,
        'intake' => $intake,
        'site' => Site::factory()->create(),
        'gender' => Gender::factory()->create(),
        'district' => District::factory()->for(Division::factory())->create(),
        'university' => University::factory()->for(UniversityCategory::factory())->create(),
        'answer_ids' => Question::factory(9)
            ->sequence(fn ($sequence) => ['label' => 'Q'.$sequence->index])
            ->create()
            ->map(fn ($question) => Answer::factory()->for($question)->create()->id)
            ->all(),
    ];
}

function registrationPayload(array $context, array $overrides = []): array
{
    [$first, $second, $third, $fourth, $fifth, $sixth, $seventh, $eighth, $ninth] = $context['answer_ids'];

    return array_merge([
        'name' => 'John Doe',
        'email' => 'jane@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'exam_id' => $context['exam']->id,
        'site_id' => $context['site']->id,
        'first_answer_id' => $first,
        'second_answer_id' => $second,
        'third_answer_id' => $third,
        'fourth_answer_id' => $fourth,
        'fifth_answer_id' => $fifth,
        'sixth_answer_id' => $sixth,
        'seventh_answer_id' => $seventh,
        'eighth_answer_id' => $eighth,
        'ninth_answer_id' => $ninth,
        'date_of_birth' => '2000-01-15',
        'gender_id' => $context['gender']->id,
        'occupation' => 'Engineer',
        'mobile_number' => '712345678',
        'present_address' => '123 Main Street',
        'work_address' => '456 Office Road',
        'post_code' => '1205',
        'district_id' => $context['district']->id,
        'university_id' => $context['university']->id,
    ], $overrides);
}

test('registration screen renders when an active intake has open registration', function () {
    seedRegistrationContext();

    $this->get(route('register'))
        ->assertOk()
        ->assertViewIs('livewire.auth.register');
});

test('registration screen shows the no-intake view when there are no active intakes', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertViewIs('livewire.auth.no-intake');
});

test('registration screen shows the no-intake view when the active intake window has closed', function () {
    $intake = Intake::factory()->for(Exam::factory())->create([
        'registration_starts_at' => now()->subDays(10),
        'registration_ends_at' => now()->subDay(),
    ]);
    $intake->setStatus('active');

    $this->get(route('register'))
        ->assertOk()
        ->assertViewIs('livewire.auth.no-intake');
});

test('registration screen redirects authenticated users', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('register'))->assertRedirect(route('dashboard', absolute: false));
});

test('new users can register while registration is open', function () {
    $context = seedRegistrationContext();

    $response = $this->post(route('register.store'), registrationPayload($context));

    $user = User::query()->where('email', 'jane@example.com')->firstOrFail();

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticatedAs($user);

    expect($user->name)->toBe('John Doe');

    $this->assertDatabaseHas('profiles', [
        'user_id' => $user->id,
        'date_of_birth' => '2000-01-15',
        'gender_id' => $context['gender']->id,
        'mobile_number' => '712345678',
        'post_code' => 1205,
        'district_id' => $context['district']->id,
        'university_id' => $context['university']->id,
        'occupation' => 'Engineer',
    ]);

    $this->assertDatabaseHas('enrollments', [
        'user_id' => $user->id,
        'intake_id' => $context['intake']->id,
        'exam_id' => $context['exam']->id,
        'site_id' => $context['site']->id,
    ]);
});

test('registration rejects a mismatched password confirmation', function () {
    $context = seedRegistrationContext();

    $this->post(route('register.store'), registrationPayload($context, [
        'password_confirmation' => 'wrong-password',
    ]))->assertSessionHasErrors('password');

    expect(User::count())->toBe(0);
});

test('registration rejects invalid mobile numbers', function (string $mobileNumber) {
    $context = seedRegistrationContext();

    $this->post(route('register.store'), registrationPayload($context, [
        'mobile_number' => $mobileNumber,
    ]))->assertSessionHasErrors('mobile_number');

    expect(User::count())->toBe(0);
})->with([
    'too short' => '12345',
    'starts outside operator range' => '212345678',
    'not numeric' => 'abcdefghi',
]);

test('registration rejects a duplicate email address', function () {
    $context = seedRegistrationContext();
    User::factory()->create(['email' => 'jane@example.com']);

    $this->post(route('register.store'), registrationPayload($context))
        ->assertSessionHasErrors('email');

    expect(User::count())->toBe(1);
});

test('registration is rejected when no intake is open for the selected exam', function () {
    $context = seedRegistrationContext();

    $closedExam = Exam::factory()->create();

    $this->post(route('register.store'), registrationPayload($context, [
        'exam_id' => $closedExam->id,
    ]))->assertSessionHasErrors();

    $errors = session('errors')->getBag('default')->get('exam_id');

    expect(reset($errors))->toContain('Registration is not open');
});

test('fe exam requires the passed_before answer', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);

    $payload = registrationPayload($context);
    unset($payload['passed_before']);

    $this->post(route('register.store'), $payload)
        ->assertSessionHasErrors('passed_before');
});

test('fe exam rejects an examinee id that was never issued', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);

    $this->post(route('register.store'), registrationPayload($context, [
        'passed_before' => 'yes',
        'examinee_id' => 'FE-UNKNOWN-001',
    ]))->assertSessionHasErrors();

    $errors = session('errors')->getBag('default')->get('examinee_id');

    expect(reset($errors))->toBe(__('Invalid ID.'));
});

test('fe exam rejects examinees who passed both sessions', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);
    $morningType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Morning (AM) Exam',
    ]);
    $afternoonType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Afternoon (PM) Exam',
    ]);

    HalfPasser::factory()->create([
        'examinee_no' => 'FE-PASSED-001',
        'type_id' => $morningType->id,
        'intake_id' => $context['intake']->id,
    ]);
    HalfPasser::factory()->create([
        'examinee_no' => 'FE-PASSED-001',
        'type_id' => $afternoonType->id,
        'intake_id' => $context['intake']->id,
    ]);

    $this->post(route('register.store'), registrationPayload($context, [
        'passed_before' => 'yes',
        'examinee_id' => 'FE-PASSED-001',
    ]))->assertSessionHasErrors();

    $errors = session('errors')->getBag('default')->get('examinee_id');

    expect(reset($errors))->toContain('already passed');
});

test('fe exam accepts a half-passer who passed only one session', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);
    $morningType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Morning (AM) Exam',
    ]);
    $afternoonType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Afternoon (PM) Exam',
    ]);

    HalfPasser::factory()->create([
        'examinee_no' => 'FE-HALF-001',
        'name' => 'John Doe',
        'type_id' => $morningType->id,
        'intake_id' => $context['intake']->id,
    ]);

    $this->post(route('register.store'), registrationPayload($context, [
        'passed_before' => 'yes',
        'examinee_id' => 'FE-HALF-001',
        'type_id' => $afternoonType->id,
    ]))->assertSessionHasNoErrors();

    $this->assertAuthenticated();

    $this->assertDatabaseHas('enrollments', [
        'exam_id' => $context['exam']->id,
        'type_id' => $afternoonType->id,
    ]);
});

test('fe exam forces both sessions when passed_before is no', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);

    $bothType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Both - Morning (AM) & Afternoon (PM) Exam',
    ]);

    $payload = registrationPayload($context, ['passed_before' => 'no']);
    unset($payload['type_id']);

    $this->post(route('register.store'), $payload)
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('enrollments', [
        'exam_id' => $context['exam']->id,
        'type_id' => $bothType->id,
    ]);
});

test('registration supports registering under another university', function () {
    $context = seedRegistrationContext();

    $this->post(route('register.store'), registrationPayload($context, [
        'university_id' => 'other',
        'other_university_name' => 'My Overseas University',
    ]))->assertSessionHasNoErrors();

    $userId = User::query()->where('email', 'jane@example.com')->value('id');

    $this->assertDatabaseHas('profiles', [
        'user_id' => $userId,
        'university_id' => null,
        'other_university_name' => 'My Overseas University',
    ]);
});

test('fe exam rejects the wrong-session type for a half-passer', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);
    $morningType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Morning (AM) Exam',
    ]);

    HalfPasser::factory()->create([
        'examinee_no' => 'FE-HP-WRONG-001',
        'type_id' => $morningType->id,
        'intake_id' => $context['intake']->id,
    ]);

    $this->post(route('register.store'), registrationPayload($context, [
        'passed_before' => 'yes',
        'examinee_id' => 'FE-HP-WRONG-001',
        'type_id' => $morningType->id,
    ]))->assertSessionHasErrors('type_id');
});

test('fe exam rejects a type belonging to another exam', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);
    $otherExam = Exam::factory()->create();
    $otherType = Type::factory()->create(['exam_id' => $otherExam->id]);

    $this->post(route('register.store'), registrationPayload($context, [
        'type_id' => $otherType->id,
    ]))->assertSessionHasErrors('type_id');
});

test('fe exam rejects a mismatched name when half-passer name is known', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);
    $morningType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Morning (AM) Exam',
    ]);
    $afternoonType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Afternoon (PM) Exam',
    ]);

    HalfPasser::factory()->create([
        'examinee_no' => 'FE-HP-NAME-001',
        'name' => 'Rahman',
        'type_id' => $morningType->id,
        'intake_id' => $context['intake']->id,
    ]);

    $this->post(route('register.store'), registrationPayload($context, [
        'name' => 'Wrong Name',
        'passed_before' => 'yes',
        'examinee_id' => 'FE-HP-NAME-001',
        'type_id' => $afternoonType->id,
    ]))->assertSessionHasErrors('name');
});

test('fe exam accepts correct name when half-passer name is known', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);
    $morningType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Morning (AM) Exam',
    ]);
    $afternoonType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Afternoon (PM) Exam',
    ]);

    HalfPasser::factory()->create([
        'examinee_no' => 'FE-HP-NAME-002',
        'name' => 'John Doe',
        'type_id' => $morningType->id,
        'intake_id' => $context['intake']->id,
    ]);

    $this->post(route('register.store'), registrationPayload($context, [
        'passed_before' => 'yes',
        'examinee_id' => 'FE-HP-NAME-002',
        'type_id' => $afternoonType->id,
    ]))->assertSessionHasNoErrors();

    $this->assertAuthenticated();
});

test('half-passer-only id completes registration end to end', function () {
    $context = seedRegistrationContext();
    $context['exam']->update(['acronym' => 'FE']);
    $morningType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Morning (AM) Exam',
    ]);
    $afternoonType = Type::factory()->create([
        'exam_id' => $context['exam']->id,
        'name' => 'FE: Afternoon (PM) Exam',
    ]);

    HalfPasser::factory()->create([
        'examinee_no' => 'FE-HP-E2E-001',
        'name' => 'Rahman',
        'type_id' => $morningType->id,
        'intake_id' => $context['intake']->id,
    ]);

    $this->post(route('register.store'), registrationPayload($context, [
        'name' => 'Rahman',
        'email' => 'rahman@example.com',
        'passed_before' => 'yes',
        'examinee_id' => 'FE-HP-E2E-001',
        'type_id' => $afternoonType->id,
    ]))->assertSessionHasNoErrors();

    $user = User::query()->where('name', 'Rahman')->firstOrFail();

    $this->assertAuthenticatedAs($user);
    $this->assertDatabaseHas('enrollments', [
        'user_id' => $user->id,
        'exam_id' => $context['exam']->id,
        'type_id' => $afternoonType->id,
    ]);
});
