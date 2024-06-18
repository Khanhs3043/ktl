<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }
    public function isFinished()
    {
        return $this->status === 'finished';
    }

    // Đánh dấu task là hoàn thành
    public function markAsFinished()
    {
        $this->status = 'finished';
        return $this->save();
    }

    // Đánh dấu task là chưa hoàn thành
    public function markAsUnfinished()
    {
        $this->status = 'unfinished';
        return $this->save();
    }
    // Kiểm tra xem task có phải do người dùng hiện tại tạo hay không, nếu không là task được người khác giao
    public function isCreatedByMe()
    {
        return $this->uid === Auth::id();
    }
}
