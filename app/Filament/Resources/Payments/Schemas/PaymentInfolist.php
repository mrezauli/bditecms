<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Transaction')
                    ->icon(Heroicon::CreditCard)
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('transaction_id')
                                ->label('Transaction ID')
                                ->copyable()
                                ->weight('bold'),
                            TextEntry::make('status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'Complete' => 'success',
                                    'Pending' => 'warning',
                                    'Failed' => 'danger',
                                    'Canceled' => 'gray',
                                    default => 'gray',
                                }),
                            TextEntry::make('amount')
                                ->money('BDT'),
                            TextEntry::make('currency')
                                ->badge(),
                        ]),
                    ]),

                Section::make('Enrollment & User')
                    ->icon(Heroicon::User)
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('enrollment.id')
                                ->label('Enrollment #'),
                            TextEntry::make('enrollment.exam.label')
                                ->label('Exam'),
                            TextEntry::make('enrollment.type.name')
                                ->label('Type')
                                ->placeholder('—'),
                            TextEntry::make('enrollment.fee')
                                ->label('Expected Fee')
                                ->money('BDT'),
                            TextEntry::make('user.name')
                                ->label('Payer'),
                            TextEntry::make('user.email')
                                ->label('Email'),
                        ]),
                    ]),

                Section::make('Timestamps')
                    ->icon(Heroicon::Clock)
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('created_at')
                                ->dateTime('d M Y, h:i A'),
                            TextEntry::make('updated_at')
                                ->dateTime('d M Y, h:i A'),
                        ]),
                    ])
                    ->collapsed(),
            ]);
    }
}
