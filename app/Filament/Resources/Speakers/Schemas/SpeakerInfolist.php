<?php

declare(strict_types=1);

namespace App\Filament\Resources\Speakers\Schemas;

use App\Enums\TalkStatus;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SpeakerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components(components: [
                Section::make('Speaker Information')
                    ->columnSpanFull()
                    ->columns(3)
                    ->components(components: [
                        ImageEntry::make('avatar')
                            ->hiddenLabel()
                            ->defaultImageUrl(url: 'https://ui-avatars.com/api/?background=C800DF&color=FFFFFF&name='.urlencode((string) $schema->getRecord()->name))
                            ->circular()
                            ->alignCenter(),
                        Section::make()
                            ->columnSpan(2)
                            ->columns()
                            ->components(components: [
                                TextEntry::make('name'),
                                TextEntry::make('email')
                                    ->label('Email address'),
                                TextEntry::make('twitter_handle')
                                    ->label('Twitter')
                                    ->getStateUsing(fn ($record) => '@'.$record->twitter_handle)
                                    ->url(fn ($record) => 'https://twitter.com/'.$record->twitter_handle),
                                TextEntry::make('has_spoken')
                                    ->getStateUsing(fn ($record) => $record->talks()->where('status', TalkStatus::APPROVED)->count() > 0 ? 'Previous Speaker' : 'Not a previous speaker')
                                    ->badge()
                                    ->color(fn ($state) => $state === 'Previous Speaker' ? 'success' : 'danger'),
                            ]),
                    ]),
                Section::make('Biography and Qualifications')
                    ->columnSpanFull()
                    ->components([
                        TextEntry::make('bio')
                            ->extraAttributes(['class' => 'prose dark:prose-invert'])
                            ->columnSpan(2),
                        TextEntry::make('qualifications')
                            ->default('No qualifications provided'),
                    ]),
            ]);
    }
}
