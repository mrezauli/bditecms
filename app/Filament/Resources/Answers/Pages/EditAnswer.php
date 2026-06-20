<?php

namespace App\Filament\Resources\Answers\Pages;

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Filament\Resources\Answers\AnswerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAnswer extends EditRecord
{
    protected static string $resource = AnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            ActivateRecordAction::make(),
            DeactivateRecordAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
