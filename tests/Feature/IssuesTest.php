<?php

use App\Livewire\Issues\Dashboard;
use App\Models\Issue;
use App\Models\IssueCategory;
use App\Models\IssueMessage;
use App\Models\User;
use Livewire\Livewire;

function createIssueUser(): User
{
    return User::factory()->create(['email_verified_at' => now()]);
}

test('guests cannot visit the issues page', function () {
    $this->get(route('issues'))->assertRedirect(route('login'));
});

test('users can create an issue with its first message', function () {
    $user = createIssueUser();
    $category = IssueCategory::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test(Dashboard::class)
        ->set('categoryId', $category->id)
        ->set('subject', 'Admit card missing')
        ->set('body', 'My admit card is not showing.')
        ->set('priority', 'high')
        ->call('createIssue');

    $component->assertHasNoErrors();

    $issue = Issue::where('user_id', $user->id)->firstOrFail();

    expect($issue->subject)->toBe('Admit card missing')
        ->and($issue->priority)->toBe('high')
        ->and($issue->status)->toBe('open');

    $this->assertDatabaseHas('issue_messages', [
        'issue_id' => $issue->id,
        'user_id' => $user->id,
        'body' => 'My admit card is not showing.',
    ]);

    $component->assertSet('selectedIssueId', $issue->id);
});

test('creating an issue requires subject and body', function () {
    $this->actingAs(createIssueUser());

    Livewire::test(Dashboard::class)
        ->set('subject', '')
        ->set('body', '')
        ->call('createIssue')
        ->assertHasErrors(['subject', 'body', 'categoryId']);

    expect(Issue::count())->toBe(0);
});

test('users can reply to their own issue', function () {
    $user = createIssueUser();
    $issue = Issue::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    Livewire::test(Dashboard::class)
        ->set('selectedIssueId', $issue->id)
        ->set('replyBody', 'Any update on this?')
        ->call('sendReply')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('issue_messages', [
        'issue_id' => $issue->id,
        'user_id' => $user->id,
        'body' => 'Any update on this?',
    ]);
});

test('users cannot open another user issue', function () {
    $user = createIssueUser();
    $otherIssue = Issue::factory()->create();

    $this->actingAs($user);

    Livewire::test(Dashboard::class)
        ->call('openIssue', $otherIssue->id)
        ->assertSet('selectedIssueId', null);
});

test('users cannot reply to another user issue', function () {
    $user = createIssueUser();
    $otherIssue = Issue::factory()->create();

    $this->actingAs($user);

    Livewire::test(Dashboard::class)
        ->set('selectedIssueId', $otherIssue->id)
        ->set('replyBody', 'Trying to hijack.')
        ->call('sendReply')
        ->assertHasNoErrors();

    expect(IssueMessage::count())->toBe(0);
});
