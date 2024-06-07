<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;
    protected $table = 'friends';
    protected $fillable = [
        'uid',
        'friend_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}
