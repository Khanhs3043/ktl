<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public function profile()
    {
        return $this->hasOne(Profile::class,'uid');
    }

    public function frequest()
    {
        return $this->hasMany(FRequest::class,'uid');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_requests',  'sender_id', 'receiver_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    public function createdGroups()
    {
        return $this->hasMany(Group::class, 'creator_id');
    }
    
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_groups', 'uid', 'group_id')
                    ->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'uid' );
    }

    public function appointmentsAsDater() // cuộc hẹn mà mình là người mời
    {
        return $this->hasMany(Appointment::class, 'dater_id');
    }

    public function appointmentsAsDateee() // cuộc hẹn mà mình là người được mời
    {
        return $this->hasMany(Appointment::class, 'dateee_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'uid' );
    }
    

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id'
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
     * Get the attributes that should be cast.
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
}
