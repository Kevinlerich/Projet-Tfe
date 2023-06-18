<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PhotographeProvince extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'photographe_provinces';
    public function province(): BelongsTo
    {
        return $this->belongsTo(Ville::class);
    }
}
