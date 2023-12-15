<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Models\Student;
use App\Imports\YourImportClass;
class ExcelImportController extends Controller
{


    public function index(Request $request)
    {
        $data = Student::latest()->paginate(5);      
        return view('import' ,compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
 
        // Get the uploaded file
        $file = $request->file('file');
 
        // Process the Excel file
        Excel::import(new YourImportClass, $file);
 
        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
