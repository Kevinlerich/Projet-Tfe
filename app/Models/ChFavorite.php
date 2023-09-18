<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;

class ChFavorite extends Model
{
    use UUID;

    protected $guarded = [];

    public function getPhotographe($id)
    {
        $user = User::query()->findOrFail($id);
        return $user->name;
    }
}
