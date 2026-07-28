<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Region: string implements HasLabel
{
    case NORTH_AMERICA = 'North America';
    case EUROPE = 'Europe';
    case ASIA = 'Asia';
    case SOUTH_AMERICA = 'South America';
    case AFRICA = 'Africa';
    case OCEANIA = 'Oceania';
    case AUSTRALIA = 'Australia';

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
