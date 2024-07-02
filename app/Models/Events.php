<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';

    public function ratings()
    {
        return $this->hasMany(Ratings::class, 'event_id');
    }
}
