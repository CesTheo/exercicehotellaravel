<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;
    public function image() : HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Categorie::class, 'location_categorie');
    }

    public function reservations () : HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    protected $fillable = [
        'nom',
        'description'
    ];



}
