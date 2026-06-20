<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class ActivateRecordAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'activate';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Activate')
            ->icon(Heroicon::CheckCircle)
            ->requiresConfirmation()
            ->color('success')
            ->hidden(fn ($record): bool => $record->hasStatus('active'))
            ->action(function ($record) {
                $record->setStatus('active');
            })
            ->successNotificationTitle('Record activated');
    }
}
