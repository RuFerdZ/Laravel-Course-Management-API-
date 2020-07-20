<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CourseModel;

use Validator;

class CourseController extends Controller
{
    public function addCourse(Request $request){
        // set validations applied on the new course to be added
        $rules = [
            'course_title' => 'required|min:4|unique:courses',
            'course_description' => 'required|min:20|max:250',
            'course_deadline' => 'required|date'
        ];

        // this validates the course
        $validator = Validator::make($request->all(),$rules);

        // if validation fails
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        // if course is valid
        $course = CourseModel::create($request->all());
        return response()->json($course,201);
    }


    public function editCourse(Request $request, $id){
         // first check whether a course in that id exists to be updated
         $course = CourseModel::find($id);

         // if there is no such course
         if(is_null($course)){
             return response()->json(["message" => "Record Not found!"],404);
         }

         // set rules for updation
         $rules = [
            'course_description' => 'required|min:20|max:250',
            'course_deadline' => 'required|date'
        ];

        // this validates the course
        $validator = Validator::make($request->all(),$rules);

        // if validation fails
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
 
         // update the database
         $course->update($request->all());
         return response()->json($course,200);
    }


    // public function setCourse(Request $request){
    //     // set validations applied on the new course to be added
    //     $rules = [
    //         'course_title' => 'required|min:4|unique:courses',
    //         'course_description' => 'required|min:20|max:250',
    //         'course_deadline' => 'required|date'
    //     ];

    //     // this validates the course
    //     $validator = Validator::make($request->all(),$rules);

    //     // if validation fails
    //     if($validator->fails()){
    //         return response()->json($validator->errors(),400);
    //     }

    //     $course = new CourseModel($request->course_title, $request->course_description, $request->course_deadline);

    //     return response()->json($course->getCourse(),201);
    // }

}
