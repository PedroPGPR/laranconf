<?php

declare(strict_types=1);

namespace App\Filament\Resources\Conferences\Schemas;

use App\Enums\Region;
use App\Filament\Resources\Venues\Schemas\VenueForm;
use App\Models\Conference;
use App\Models\Speaker;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class ConferenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Actions::make([
                Action::make('plus')
                    ->icon('heroicon-o-plus-circle')
                    ->label('Fill form')
                    ->visible(function (string $operation): bool {
                        if ($operation !== 'create') {
                            return false;
                        }

                        return (bool) app()->environment('local');
                    })
                    ->action(function ($livewire) {
                        $data = Conference::factory()->make()->toArray();
                        $livewire->form->fill($data);
                    }),
            ]),
            Section::make('Conference Details')
                ->columns(2)
                ->columnSpanFull()
                ->description('Details about the conference')
                ->collapsible()
                ->schema([
                    TextInput::make('name')
                        ->columnSpan(2)
                        ->label('Conference')
                        ->default('My Conference')
                        ->maxLength(60)
                        ->required(),
                    MarkdownEditor::make('description')
                        ->columnSpan(2)
                        ->disableToolbarButtons(['attachFiles', 'undo', 'redo'])
                        ->required(),
                    DateTimePicker::make('start_date')
                        ->columnSpan(1)
                        ->native(false)
                        ->required(),
                    DateTimePicker::make('end_date')
                        ->columnSpan(1)
                        ->native(false)
                        ->required(),
                    Fieldset::make('Status')
                        ->columnSpan(2)
                        ->schema([
                            Select::make('status')
                                ->columnSpan(2)
                                ->native(false)
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                    'archived' => 'Archived',
                                ])
                                ->required(),
                            Toggle::make('is_published')
                                ->default(true),
                        ]),
                ]),
            Section::make('Location')
                ->columns(2)
                ->columnSpanFull()
                ->collapsible()
                ->schema([
                    Select::make('region')
                        ->columnSpan(1)
                        ->live()
                        ->enum(Region::class)
                        ->options(Region::class)
                        ->required(),
                    Select::make('venue_id')
                        ->columnSpan(1)
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->createOptionForm(fn (Schema $schema) => VenueForm::configure($schema))
                        ->editOptionForm(fn (Schema $schema) => VenueForm::configure($schema))
                        ->relationship(
                            'venue',
                            'name',
                            modifyQueryUsing: fn (Builder $query, Get $get) => $query->where('region', $get('region'))
                        ),
                ]),
            Fieldset::make('Speakers')
                ->columns(3)
                ->columnSpanFull()
                ->schema([
                    CheckboxList::make('speakers')
                        ->hiddenLabel()
                        ->columnSpanFull()
                        ->columns(3)
                        ->searchable()
                        ->relationship('speakers', 'name')
                        ->options(Speaker::pluck('name', 'id')->all()),
                ]),
        ]);
    }
}
