<?php

use App\Models\Answer;
use App\Models\District;
use App\Models\Division;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\Intake;
use App\Models\Question;
use App\Models\Site;
use App\Models\University;
use App\Models\UniversityCategory;
use App\Models\User;

function previewSeedContext(): array
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

function previewPayload(array $context, array $overrides = []): array
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

test('preview stores valid input in session without persisting', function () {
    $context = previewSeedContext();

    $response = $this->post(route('register.preview'), previewPayload($context));

    $response->assertRedirect(route('register.preview.show'));
    $this->assertNotNull(session('registration_preview'));
    $this->assertNotNull(session('registration_preview_display'));

    expect(User::count())->toBe(0);
});

test('preview show renders the stored details', function () {
    $context = previewSeedContext();

    $this->post(route('register.preview'), previewPayload($context));

    $this->get(route('register.preview.show'))
        ->assertOk()
        ->assertViewIs('livewire.auth.register-preview')
        ->assertSee('jane@example.com')
        ->assertSee('+8801712345678', false);
});

test('preview rejects invalid input without storing session', function () {
    $context = previewSeedContext();

    $response = $this->post(route('register.preview'), previewPayload($context, [
        'mobile_number' => '12345',
    ]));

    $response->assertRedirect(route('register'));
    $response->assertSessionHasErrors('mobile_number');
    $this->assertNull(session('registration_preview'));

    expect(User::count())->toBe(0);
});

test('preview show redirects to register without session', function () {
    $this->get(route('register.preview.show'))->assertRedirect(route('register'));
});

test('confirm creates the user and logs them in', function () {
    $context = previewSeedContext();

    $this->post(route('register.preview'), previewPayload($context));

    $response = $this->post(route('register.confirm'));

    $user = User::query()->where('email', 'jane@example.com')->firstOrFail();

    $response->assertRedirect(route('dashboard', absolute: false));
    $this->assertAuthenticatedAs($user);
    $this->assertNull(session('registration_preview'));

    $this->assertDatabaseHas('profiles', [
        'user_id' => $user->id,
        'mobile_number' => '712345678',
    ]);
    $this->assertDatabaseHas('enrollments', [
        'user_id' => $user->id,
        'exam_id' => $context['exam']->id,
    ]);
});

test('confirm without session redirects to register with an error', function () {
    $response = $this->post(route('register.confirm'));

    $response->assertRedirect(route('register'));
    $response->assertSessionHas('error');

    expect(User::count())->toBe(0);
});

test('back without session redirects to register', function () {
    $this->post(route('register.preview.back'))->assertRedirect(route('register'));
});

test('back restores the typed input to the form', function () {
    $context = previewSeedContext();

    $this->post(route('register.preview'), previewPayload($context));

    $response = $this->post(route('register.preview.back'));

    $response->assertRedirect(route('register'));
    $this->assertEquals('jane@example.com', session()->getOldInput('email'));
});
