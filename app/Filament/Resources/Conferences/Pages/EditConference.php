<?php

declare(strict_types=1);

namespace App\Filament\Resources\Conferences\Pages;

use App\Filament\Resources\Conferences\ConferenceResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Override;

class EditConference extends EditRecord
{
    protected static string $resource = ConferenceResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
