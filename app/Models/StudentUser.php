<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentUser extends Model
{
protected $table = 'student_user';

    protected $fillable = [
    'student_id', 'user_id',
    ];
}
