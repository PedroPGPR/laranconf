<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class Speaker extends Model
{
    use HasFactory;

    const QUALIFICATIONS = [
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
    ];

    #[Override]
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'qualifications' => 'array',
        ];
    }

    public function conferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class);
    }

    public function talks(): HasMany
    {
        return $this->hasMany(Talk::class, 'speaker_id');
    }
}
