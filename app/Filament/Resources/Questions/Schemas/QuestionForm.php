<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('label')
                    ->options(collect(range(1, 9))->mapWithKeys(fn ($i) => ["Q{$i}" => "Q{$i}"]))
                    ->required(),
                TextInput::make('content')
                    ->required(),
            ]);
    }
}
