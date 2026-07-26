<?php

namespace App\Filament\Resources\ExamSessions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('exam_id')
                    ->relationship('exam', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                DatePicker::make('exam_date')
                    ->required(),
                DateTimePicker::make('registration_starts_at')
                    ->required(),
                DateTimePicker::make('registration_ends_at')
                    ->required()
                    ->after('registration_starts_at'),
                DateTimePicker::make('result_published_at'),
            ]);
    }
}
