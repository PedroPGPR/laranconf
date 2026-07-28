<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class Venue extends Model
{
    use HasFactory;

    #[Override]
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'region' => Region::class,
        ];
    }

    public function conferences(): HasMany
    {
        return $this->hasMany(Conference::class);
    }
}
