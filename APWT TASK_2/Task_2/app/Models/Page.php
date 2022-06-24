<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $primarykey="phone";

    public function assignedCourses(){
        $details= Course::where("teacherId",$this->id)->get();
        // return $details;
        return view('pages.teacher.teacherCourses')->with('details', $details);
    }
}
