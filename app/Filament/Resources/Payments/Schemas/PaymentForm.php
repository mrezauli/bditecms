<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('enrollment_id')
                    ->relationship('enrollment', 'id')
                    ->disabled()
                    ->dehydrated(false),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('amount')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('transaction_id')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('val_id')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('bank_tran_id')
                    ->disabled()
                    ->dehydrated(false),
                Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Complete' => 'Complete',
                        'Failed' => 'Failed',
                        'Canceled' => 'Canceled',
                    ])
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('currency')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }
}
