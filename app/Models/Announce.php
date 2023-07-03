<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announce extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected array $dates = ['created_at', 'updated_at', 'date_announce'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ville(): BelongsTo
    {
        return $this->belongsTo(Ville::class);
    }
}
