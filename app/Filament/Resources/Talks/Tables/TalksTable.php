<?php

declare(strict_types=1);

namespace App\Filament\Resources\Talks\Tables;

use App\Enums\TalkLength;
use App\Enums\TalkStatus;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TalksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(components: [
                ImageColumn::make('speaker.avatar')
                    ->label('Avatar')
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?background=C800DF&color=FFFFFF&name='.urlencode((string) $record->speaker->name))
                    ->circular(),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->description(fn ($record) => Str::limit($record->abstract, 50)),
                TextColumn::make('speaker.name')
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('new_talk')
                    ->label('New Talk')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state->getColor())
                    ->icon(icon: fn ($state) => match ($state) {
                        TalkStatus::SUBMITTED => 'heroicon-o-clock',
                        TalkStatus::APPROVED => 'heroicon-o-check-circle',
                        TalkStatus::REJECTED => 'heroicon-o-x-circle',
                        default => null,
                    })
                    ->alignCenter(),
                IconColumn::make('length')
                    ->icon(icon: fn ($state) => match ($state) {
                        TalkLength::NORMAL => 'heroicon-o-megaphone',
                        TalkLength::LIGHTNING => 'heroicon-o-bolt',
                        TalkLength::KEYNOTE => 'heroicon-o-key',
                    })
                    ->label('Length')
                    ->sortable()
                    ->alignCenter(),
            ])
            ->filters([
                TernaryFilter::make('new_talk'),
                SelectFilter::make('speaker')
                    ->relationship('speaker', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Filter::make('has_avatar')
                    ->query(fn ($query) => $query->whereHas('speaker', function ($query) {
                        $query->whereNotNull('avatar');
                    }))
                    ->label('Show only speakers with avatar'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
