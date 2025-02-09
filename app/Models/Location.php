<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that can be mass assigned.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'location'
    ];

    public $timestamps = true;

    /**
     * Get the zoom records associated with the location.
     * Defines one-to-many relationship with Zoom model.
     *
     * @return HasMany
     */
    public function zoom() : HasMany
    {
        return $this->hasMany(Zoom::class);
    }
}
