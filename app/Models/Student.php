<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imie', 'nazwisko','numer_indeksu','miejsce_zamieszkania','numer_telefonu'
    ];
    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_student', 'student_id', 'class_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_classes', 'class_id', 'user_id');
    }

}
