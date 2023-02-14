<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $student = new Student;
        $student->name = $request->input("name");
        $student->course = $request->input("course");
        $student->email = $request->input("email");
        $student->phone = $request->input("phone");
        $student->save();

        return response()->json([
            'status' => 200,
            'message' => 'Student Add Successfully'
        ]);
    }
    public function getData()
    {
        return response()->json(Student::all());
    }
    public function destroy(Request $request)
    {
        return Student::destroy($request->id);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($request->id);
        $student->name = $request->input("name");
        $student->course = $request->input("course");
        $student->email = $request->input("email");
        $student->phone = $request->input("phone");
        $student->save();
        return  response()->json([
            'status' => 200,
            'message' => 'Student success, Student updated successfully'
        ]);
    }
}
