<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Collage;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
 
    public function index()
    {
        $data = Student::latest()->paginate(5);

        return view('index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

  
    public function create()
    {
        $collage = Collage::get();     
        $course = Course::get();     

        return view('create',compact('collage','course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name'          =>  'required',
            'collage_name'          =>  'required',
            'course_name'          =>  'required',
            'student_email'         =>  'required|email|unique:students',
            'student_image'         =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $file_name = time() . '.' . request()->student_image->getClientOriginalExtension();

        request()->student_image->move(public_path('images'), $file_name);

        $student = new Student;

        $student->student_name = $request->student_name;
        $student->student_email = $request->student_email;
        $student->student_gender = $request->student_gender;
        $student->collage_id = $request->collage_name;
        $student->course_id = $request->course_name;
        $student->student_image = $file_name;

        $student->save();

        return redirect()->route('students.index')->with('success', 'Student Added successfully.');
    }


    public function show(Student $student)
    {

        // dd($student->course);
        return view('show', compact('student'));
    }

    public function edit(Student $student)
    {
        $collage = Collage::get();     
        $course = Course::get();  
        return view('edit', compact('student','collage','course'));
    }


    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_name'      =>  'required',
            'student_email'     =>  'required|email',
            'student_image'     =>  'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        ]);

        $student_image = $request->hidden_student_image;

        if($request->student_image != '')
        {
            $student_image = time() . '.' . request()->student_image->getClientOriginalExtension();

            request()->student_image->move(public_path('images'), $student_image);
        }

        $student = Student::find($request->hidden_id);

        $student->student_name = $request->student_name;

        $student->student_email = $request->student_email;

        $student->student_gender = $request->student_gender;
       $student->collage_id = $request->collage_name;
        $student->course_id = $request->course_name;

        $student->student_image = $student_image;

        $student->save();

        return redirect()->route('students.index')->with('success', 'Student Data has been updated successfully');
    }

   
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student Data deleted successfully');
    }


    
}



