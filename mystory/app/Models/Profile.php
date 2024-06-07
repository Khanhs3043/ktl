<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';

    protected $fillable = [
        'uid',
        'username',
        'avatar',
        'dob',
        'bio',
        'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}
