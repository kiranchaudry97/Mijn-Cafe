<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar_path',
        'birthday',
        'bio',
        'profile_photo',
    ];

    /**
     * Attributes hidden from serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Type casting for attributes.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthday' => 'date',
    ];

    /**
     * Relatie: gebruiker heeft meerdere nieuwsartikelen.
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }

    /**
     * Relatie: gebruiker heeft meerdere bestellingen.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relatie: gebruiker heeft meerdere reacties.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Accessor voor profielfoto URL.
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo && Storage::disk('public')->exists($this->profile_photo)
            ? asset('storage/' . $this->profile_photo)
            : asset('images/default-avatar.png');
    }
}