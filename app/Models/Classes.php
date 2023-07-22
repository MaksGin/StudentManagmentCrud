<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nazwa', 'rok_szkolny','profil','wychowawca','liczba_uczniow','godziny_lekcyjne'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_classes', 'class_id', 'user_id');
    }
}
