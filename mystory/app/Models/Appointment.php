<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';

    protected $fillable = [
        'dater_id',
        'dateee_id',
        'title',
        'des',
        'start',
        'end',
    ];

    protected $dates = [
        'start',
        'end',
    ];

    // Định nghĩa quan hệ với bảng users (người tạo cuộc hẹn và người được mời)
    public function dater()
    {
        return $this->belongsTo(User::class, 'dater_id');
    }

    public function dateee()
    {
        return $this->belongsTo(User::class, 'dateee_id');
    }
}
