<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('name_bn')
                    ->label('Name (Bengali)')
                    ->required(),
                Select::make('division_id')
                    ->relationship('division', 'name')
                    ->required(),
            ]);
    }
}
