<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * These fields can be filled when creating/updating a user
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'role_id',
        'job_as',
        'profile_image',
        'status',
    ];

    public $timestamps = true;

    /**
     * The attributes that should be hidden when serializing the model.
     * Sensitive data that shouldn't be exposed in responses
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to specific types.
     * Defines how certain attributes should be transformed when retrieved/stored
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Define relationships with other models
     * 
     * Get the role associated with this user
     *
     * @return BelongsTo
     */
    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get all zoom meeting participations for this user
     *
     * @return HasMany
     */
    public function participant() : HasMany
    {
        return $this->hasMany(UsersZoom::class);
    }

    /**
     * Get all zoom meetings this user is associated with
     * 
     * @return BelongsToMany
     */
    public function zooms() : BelongsToMany
    {
        return $this->belongsToMany(Zoom::class);
    } 
}
