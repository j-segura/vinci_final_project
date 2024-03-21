<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function socialMedias()
    {
        return $this->belongsToMany(SocialMedia::class, 'social_medias_users', 'user_id', 'social_media_id')->withPivot('url');
    }

    public function authoredReferences()
    {
        return $this->hasMany(Reference::class, 'author_id');
    }

    public function ownedReferences()
    {
        return $this->hasMany(Reference::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

}

