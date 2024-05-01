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
        'phone',
        'image',
        'display_name',
        'about_me',
        'age',
        'height',
        'weight',
        'ethnicity',
        'body_type',
        'position',
        'tribes',
        'relationship_status',
        'looking_for',
        'meet_at',
        'accept_nsfw_pics',
        'gender',
        'pronouns',
        'hiv_status',
        'lab_tested',
        'test_reminder_date',
        'vaccination',
        'instagram',
        'spotify',
        'twitter',
        'facebook',
        'views',
        'latitude',
        'longitude',
        'fcm_token',
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


    public function gallery()
    {
        return $this->hasMany(UserGallery::class);
    }
    public function sentMessages()
{
    return $this->hasMany(Chats::class, 'sender_id', 'id');
}

public function receivedMessages()
{
    return $this->hasMany(Chats::class, 'receiver_id', 'id');
}
public function subscription()
{
    return $this->hasOne(UserSubscription::class);

}
}
