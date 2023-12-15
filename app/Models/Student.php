<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Student extends Model
{
    use HasFactory;

      protected $fillable = ['student_name', 'student_email', 'student_gender', 'student_image','collage_id','course_id'];


    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

     public function Collage()
    {
        return $this->belongsTo(Collage::class);
    }

    
}
