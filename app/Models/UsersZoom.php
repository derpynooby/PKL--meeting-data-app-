<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsersZoom extends Model
{
    use HasFactory;

    /**
     * The attributes that can be mass assigned.
     * This model represents the pivot table between Users and Zoom meetings
     * Contains user_id, zoom_id and documentation fields
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'zoom_id', 
        'documentation',
    ];

    public $timestamps = true;

    /**
     * Get the associated Zoom meeting record
     * Defines many-to-one relationship with Zoom model
     *
     * @return BelongsTo
     */
    public function zoom() : BelongsTo
    {
        return $this->belongsTo(Zoom::class);
    }

    /**
     * Get the associated User record
     * Defines many-to-one relationship with User model
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
