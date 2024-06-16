<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';

    protected $fillable = [
        'uid',
        'title',
        'des',
        'assign_to',
        'due_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}
