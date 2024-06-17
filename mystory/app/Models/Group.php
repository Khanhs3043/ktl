<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'creator_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_groups', 'group_id', 'uid')
                    ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    
    public function members()
    {
        return $this->belongsToMany(User::class, 'user_groups', 'group_id', 'uid')
                    ->withTimestamps();
    }
    public function membersCount(){
        return count($this->members);
    }
    public function addMember($memberId){
        if (!$this->members()->where('uid', $memberId)->exists()) {
            // Thêm người dùng vào nhóm nếu chưa là thành viên
            $this->members()->attach($memberId);
        }
    }
}
