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
    public function friendRequestsReceived()
    {
        return $this->hasMany(FRequest::class, 'receiver_id')
                    ->where('status', 'pending');
    }

    // Lấy tất cả yêu cầu kết bạn từ mình đến người khác
    public function friendRequestsSent()
    {
        return $this->hasMany(FRequest::class, 'sender_id')
                    ->where('status', 'pending');
    }
    public function checkFriendRequestStatus($userId)
    {
        $requestSent = $this->friendRequestsSent()
                            ->where('receiver_id', $userId)
                            ->first();
        if ($requestSent) {
            return $requestSent->status;
        }

        $requestReceived = $this->friendRequestsReceived()
                                ->where('sender_id', $userId)
                                ->first();
        if ($requestReceived) {
            return $requestReceived->status;
        }

        return null; // Không có yêu cầu kết bạn
    }
    public function deleteFriendRequest($userId)
    {
        $requestSent = $this->friendRequestsSent()
                            ->where('receiver_id', $userId)
                            ->first();
        if ($requestSent) {
            $requestSent->delete();
            return true;
        }
        return false; // Không có yêu cầu kết bạn để xóa
    }

    public function sentFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'sender_id', 'receiver_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    // Quan hệ để lấy bạn bè mà mình đã nhận yêu cầu và mình chấp nhận
    public function receivedFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'receiver_id', 'sender_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    // Quan hệ để lấy tất cả bạn bè (kết hợp cả hai chiều)
    public function friends()
    {
        $sentFriends = $this->sentFriendRequests()->get();
        $receivedFriends = $this->receivedFriendRequests()->get();
        
        // Hợp nhất các tập hợp bạn bè
        return $sentFriends->merge($receivedFriends);
    }
    public function isFriendWith($userId)
    {
        return $this->friends()->contains('id', $userId);
    }
    public function countFriends()
    {
        return $this->friends()->count();
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'receiver_id', 'sender_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }
    public function createdGroups() //group tự tạo
    {
        return $this->hasMany(Group::class, 'creator_id');
    }
    
    public function groups() //group mà mình là thành viên
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

// task
    public function tasks()
    {
        return $this->hasMany(Task::class, 'uid' );
    }
    public function alltasks(){
        $createdTasks =  $this->tasks()->get();
        $assignedTasks = $this->assignedTasks()->get();
    return $createdTasks->merge($assignedTasks);
    }

    public function completedTasks()
    {
        return $this->alltasks()->where('status', 'finished');
    }

    public function incompleteTasks()
    {
        return $this->alltasks()->where('status', 'unfinished');
    }

    public function overdueTasks()
    {
        return $this->alltasks()->where('status', 'unfinished')->where('due_date', '<', now());
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assign_to');
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
