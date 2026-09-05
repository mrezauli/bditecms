<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('enrollment.id')
                    ->label('Enrollment')
                    ->formatStateUsing(fn ($record) => '#'.$record->enrollment_id.' • '.($record->enrollment?->exam?->acronym ?? '—'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->description(fn ($record) => $record->user?->email)
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Amount (BDT)')
                    ->money('BDT')
                    ->sortable(),
                TextColumn::make('transaction_id')
                    ->label('Transaction ID')
                    ->searchable()
                    ->copyable()
                    ->limit(24)
                    ->tooltip(fn ($record) => $record->transaction_id),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Complete' => 'success',
                        'Pending' => 'warning',
                        'Failed' => 'danger',
                        'Canceled' => 'gray',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): mixed => match ($state) {
                        'Complete' => Heroicon::CheckCircle,
                        'Pending' => Heroicon::Clock,
                        'Failed' => Heroicon::XCircle,
                        'Canceled' => Heroicon::NoSymbol,
                        default => null,
                    }),
                TextColumn::make('currency')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Paid At')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Complete' => 'Complete',
                        'Failed' => 'Failed',
                        'Canceled' => 'Canceled',
                    ]),
                SelectFilter::make('currency')
                    ->options(['BDT' => 'BDT']),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
