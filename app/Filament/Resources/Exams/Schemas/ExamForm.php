<?php

namespace App\Filament\Resources\Exams\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('acronym')
                    ->required(),
                TextInput::make('level')
                    ->required(),
                Textarea::make('details')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
