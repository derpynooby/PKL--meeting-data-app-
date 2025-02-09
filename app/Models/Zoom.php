<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zoom extends Model
{
    use HasFactory;

    /**
     * The attributes that can be mass assigned.
     * These fields can be filled when creating or updating a Zoom record
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'location_id', 
        'start',
        'end',
        'datetime',
        'link',
        'description',
        'created_by',
    ];

    public $timestamps = true;

    /**
     * Get the location associated with the zoom meeting
     * This establishes a belongs to relationship with Location model
     *
     * @return BelongsTo
     */
    public function location() : BelongsTo
    {
        return $this->belongsTo(Location::class);
    }   

    /**
     * Get the users associated with the zoom meeting
     * This establishes a many-to-many relationship with User model
     * 
     * @return BelongsToMany
     */
    public function user() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the participants of the zoom meeting
     * This establishes a one-to-many relationship with UsersZoom model
     *
     * @return HasMany
     */
    public function participant() : HasMany
    {
        return $this->hasMany(UsersZoom::class);
    }
}
