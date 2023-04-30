<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function Location (): BelongsToMany {
        return $this->belongsToMany(Location::class);
    }
}
