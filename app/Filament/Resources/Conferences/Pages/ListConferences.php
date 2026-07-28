<?php

declare(strict_types=1);

namespace App\Filament\Resources\Conferences\Pages;

use App\Filament\Resources\Conferences\ConferenceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Override;

class ListConferences extends ListRecords
{
    protected static string $resource = ConferenceResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
