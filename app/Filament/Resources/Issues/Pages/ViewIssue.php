<?php

namespace App\Filament\Resources\Issues\Pages;

use App\Filament\Resources\Issues\IssueResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewIssue extends ViewRecord
{
    protected static string $resource = IssueResource::class;

    public string $replyBody = '';

    public ?string $newStatus = null;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        $this->newStatus = $this->record?->status;
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            ...parent::content($schema)->getComponents(),
            Section::make('Messages')
                ->schema([
                    Textarea::make('replyBody')
                        ->label('Your Reply')
                        ->rows(3)
                        ->placeholder('Type your reply...'),
                ])
                ->footerActions([
                    Action::make('sendReply')
                        ->label('Send Reply')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Send Reply')
                        ->modalSubmitActionLabel('Send')
                        ->action(fn () => $this->sendReply()),
                ]),
        ]);
    }

    public function sendReply(): void
    {
        if (empty(trim($this->replyBody)) || ! $this->record) {
            return;
        }

        $this->record->messages()->create([
            'user_id' => auth()->id(),
            'body' => $this->replyBody,
        ]);

        $this->replyBody = '';

        Notification::make()
            ->title('Reply sent')
            ->success()
            ->send();
    }

    public function updateStatus(): void
    {
        if ($this->newStatus && $this->newStatus !== $this->record?->status) {
            $this->record->update(['status' => $this->newStatus]);

            Notification::make()
                ->title('Status updated to '.ucfirst($this->newStatus))
                ->success()
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
