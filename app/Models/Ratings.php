<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    

    protected $fillable = ['event_id', 'user_id', 'rating'];

    // Assuming relationships are correctly defined
    public function event()
    {
        return $this->belongsTo(Events::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



