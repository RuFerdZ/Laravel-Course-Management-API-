<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table = "courses";

    private $id = '';
    private $course_title;
    private $course_description;
    private $course_deadline;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'course_title',
        'course_description',
        'course_deadline'
    ];


    // function __construct($course_title, $course_description, $course_deadline){
    //     $this->course_title = $course_title;
    //     $this->course_description = $course_description;
    //     $this->course_deadline = $course_deadline;
    // }

    function getCourse(){ 
        $fillable = [
            $this->course_title,
            $this->course_description,
            $this->course_deadline
        ];
        return $fillable;
    }
}
