<?php

declare(strict_types=1);

namespace App\Filament\Resources\Speakers\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SpeakerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                FileUpload::make('avatar')
                    ->avatar()
                    ->imageEditor()
                    ->maxSize(1024 * 1024 * 5),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                MarkdownEditor::make('bio')
                    ->columnSpanFull(),
                TextInput::make('twitter_handle')
                    ->columnSpanFull(),
                CheckboxList::make('qualifications')
                    ->columnSpanFull()
                    ->searchable()
                    ->bulkToggleable()
                    ->options([
                        'business-leader' => 'Business Leader',
                        'charisma' => 'Charisma',
                        'first-time' => 'First Time',
                        'hometown-hero' => 'Hometown Hero',
                        'industry-expert' => 'Industry Expert',
                        'inspirational' => 'Inspirational',
                        'humanitarian' => 'Humanitarian',
                        'laracasts-contributor' => 'Laracasts Contributor',
                        'mentor' => 'Mentor',
                        'open-source-contributor' => 'Open Source Contributor',
                        'podcaster' => 'Podcaster',
                        'public-speaker' => 'Public Speaker',
                        'social-media-influencer' => 'Social Media Influencer',
                        'thought-leader' => 'Thought Leader',
                        'unique-perspective' => 'Unique perspective',
                    ])
                    ->descriptions([
                        'business-leader' => 'Dudes who are CEO\'s',
                        'charisma' => 'Dudes who are charismatic',
                        'first-time' => 'The first time speaking at a conference',
                        'hometown-hero' => 'The local dudes',
                        'industry-expert' => 'The mastermind\'s of the business',
                        'inspirational' => 'Inspiring individuals',
                        'humanitarian' => 'Humanitarian efforts',
                        'laracasts-contributor' => 'Contributors to Laracasts',
                        'mentor' => 'Experienced mentors',
                        'open-source-contributor' => 'Contributors to open source',
                        'podcaster' => 'Individuals who host podcasts',
                        'public-speaker' => 'Individuals who speak publicly',
                        'social-media-influencer' => 'Influencers on social media',
                        'thought-leader' => 'Recognized thought leaders',
                        'unique-perspective' => 'Individuals with a unique perspective',
                    ])
                    ->columns(3),
            ]);
    }
}
