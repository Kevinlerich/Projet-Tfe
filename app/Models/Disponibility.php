<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use DateTime;

class Disponibility extends Model
{
    use HasFactory;

    protected $dates = ['debut', 'fin', 'created_at', 'updated_at'];
    protected $dateFormat = DateTime::ISO8601;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
