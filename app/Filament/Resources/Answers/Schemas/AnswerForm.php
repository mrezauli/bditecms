<?php

namespace App\Filament\Resources\Answers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnswerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('label')
                    ->required(),
                TextInput::make('content')
                    ->required(),
                Select::make('question_id')
                    ->relationship('question', 'label')
                    ->required(),
            ]);
    }
}
