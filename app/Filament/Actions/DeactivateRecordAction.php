<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

class DeactivateRecordAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'deactivate';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Deactivate')
            ->icon(Heroicon::XCircle)
            ->requiresConfirmation()
            ->color('danger')
            ->visible(fn ($record): bool => $record->hasStatus('active'))
            ->action(function ($record) {
                $record->deleteStatus('active');
            })
            ->successNotification(
                Notification::make()
                    ->danger()
                    ->title('Record deactivated'),
            );
    }
}
