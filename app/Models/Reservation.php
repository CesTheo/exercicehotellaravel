<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    use HasFactory;


    protected $fillable = [
        'start_at',
        'end_at',
        'user_id',
        'location_id',
    ];

    public function location () : BelongsTo {
        return $this->belongsTo(Location::class);
    }

    public function user () : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
