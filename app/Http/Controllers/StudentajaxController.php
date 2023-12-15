<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Collage;
use App\Models\Course;

class StudentajaxController extends Controller
{
    
    function student_add(Request $request){
        $insert = [
            'student_name' => $request->name,
            'student_email'=> $request->email,
            'student_gender' => $request->gender,
            'collage_id' => $request->collage,
            'course_id' => $request->course
        ];
        $add = Student::create($insert);
        if($add){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record created succesfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record created failed!'
            ];
            return $response;
        }
    } 

    function student_view(Request $request){
        return Student::with('course','collage')->find($request->id);
    } 

    function student_delete(Request $request){
        $delete =  Student::destroy($request->id);
        if($delete){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record deleted succesfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record deleted failed!'
            ];
            return $response;
        }
    } 

    function student_edit(Request $request){
        $update = [
            'student_name' => $request->name,
            'student_email'=> $request->email,
            'student_gender' => $request->gender,
            'collage_id' => $request->collage,
            'course_id' => $request->course
        ];
        $edit = Student::where('id', $request->employee_id)->update($update);
        if($edit){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record updated succesfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record updated failed!'
            ];
            return $response;
        }
    } 

    function student_list(){
        return Student::with('course','collage')->get();
    }

}
