<?php

namespace App\Livewire\Issues;

use App\Models\Issue;
use App\Models\IssueCategory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Issues')]
class Dashboard extends Component
{
    public ?int $selectedIssueId = null;

    public bool $showCreateModal = false;

    public string $subject = '';

    public string $body = '';

    public ?int $categoryId = null;

    public string $priority = 'medium';

    public string $replyBody = '';

    #[Computed]
    public function issues()
    {
        return auth()->user()
            ->issues()
            ->with('category')
            ->latest()
            ->get();
    }

    #[Computed]
    public function categories()
    {
        return IssueCategory::all();
    }

    #[Computed]
    public function selectedIssue()
    {
        if (! $this->selectedIssueId) {
            return null;
        }

        return Issue::with(['messages.user', 'category'])
            ->where('user_id', auth()->id())
            ->find($this->selectedIssueId);
    }

    #[Computed]
    public function selectedIssueMessages()
    {
        if (! $this->selectedIssueId) {
            return collect();
        }

        return Issue::find($this->selectedIssueId)
            ?->messages()
            ->with('user')
            ->oldest()
            ->get()
            ?? collect();
    }

    public function openIssue(int $issueId): void
    {
        $issue = Issue::find($issueId);

        if ($issue && $issue->user_id === auth()->id()) {
            $this->selectedIssueId = $issueId;
        }
    }

    public function closeIssue(): void
    {
        $this->selectedIssueId = null;
        $this->replyBody = '';
    }

    public function openCreateModal(): void
    {
        $this->showCreateModal = true;
        $this->subject = '';
        $this->body = '';
        $this->categoryId = null;
        $this->priority = 'medium';
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
    }

    public function createIssue(): void
    {
        $this->validate([
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'categoryId' => ['required', 'exists:issue_categories,id'],
            'priority' => ['required', 'in:low,medium,high'],
        ]);

        $issue = Issue::create([
            'user_id' => auth()->id(),
            'issue_category_id' => $this->categoryId,
            'subject' => $this->subject,
            'priority' => $this->priority,
            'status' => 'open',
        ]);

        $issue->messages()->create([
            'user_id' => auth()->id(),
            'body' => $this->body,
        ]);

        $this->closeCreateModal();
        $this->selectedIssueId = $issue->id;
    }

    public function sendReply(): void
    {
        $this->validate([
            'replyBody' => ['required', 'string'],
        ]);

        if (! $this->selectedIssueId) {
            return;
        }

        $issue = Issue::where('user_id', auth()->id())->find($this->selectedIssueId);

        if (! $issue) {
            return;
        }

        $issue->messages()->create([
            'user_id' => auth()->id(),
            'body' => $this->replyBody,
        ]);

        $this->replyBody = '';
    }

    public function render()
    {
        return view('livewire.issues.dashboard');
    }
}
