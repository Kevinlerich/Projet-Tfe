<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RendezVous extends Model
{
    use HasFactory;

    protected $guarded = [];
    //protected $dates = ['debut', 'fin'];

    public array $ETAT = [
        'up_coming' => 'Up Coming',
        'validated' => 'Validated',
        'pass' => 'Pass',
        'cancel' => 'Canceled'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function photographe(): BelongsTo
    {
        return $this->belongsTo(User::class, 'photographe_id', 'id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function scheduler(): BelongsTo
    {
        return $this->belongsTo(Scheduler::class);
    }
/*
    public function getDebutAttribute()
    {
        return $this->debut->format('c');
    }

    public function getFinAttribute()
    {
        return $this->fin->format('c');
    } */
}
