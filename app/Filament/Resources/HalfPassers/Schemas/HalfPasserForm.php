<?php

namespace App\Filament\Resources\HalfPassers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HalfPasserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('examinee_no')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                Select::make('type_id')
                    ->relationship('type', 'name')
                    ->required(),
                Select::make('intake_id')
                    ->relationship('intake', 'name')
                    ->required(),
            ]);
    }
}
