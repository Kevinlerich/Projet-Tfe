<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ville extends Model
{
    use HasFactory;
    protected $table = 'provinces';

    protected $guarded = [];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function announces(): HasMany
    {
        return $this->hasMany(Announce::class);
    }

    public function photographes(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'users');
    }
}
