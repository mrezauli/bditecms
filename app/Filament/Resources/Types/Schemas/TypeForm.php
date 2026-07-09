<?php

namespace App\Filament\Resources\Types\Schemas;

use App\Models\Exam;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('exam_id')
                    ->relationship('exam', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Exam $exam) => $exam->label)
                    ->required(),
            ]);
    }
}
