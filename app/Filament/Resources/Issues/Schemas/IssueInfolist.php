<?php

namespace App\Filament\Resources\Issues\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class IssueInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Raised by'),
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('subject')
                    ->label('Subject'),
                TextEntry::make('priority')
                    ->label('Priority')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'success',
                        default => 'gray',
                    }),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'warning',
                        'in_progress' => 'info',
                        'resolved' => 'success',
                        default => 'gray',
                    }),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Created'),
            ]);
    }
}
