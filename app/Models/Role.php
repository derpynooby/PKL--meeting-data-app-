<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that can be mass assigned.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role'
    ];

    public $timestamps = true;

    /**
     * Get the users associated with the role.
     * Defines one-to-many relationship with User model.
     *
     * @return HasMany
     */
    public function user() : HasMany 
    {
        return $this->hasMany(User::class);
    }
}
