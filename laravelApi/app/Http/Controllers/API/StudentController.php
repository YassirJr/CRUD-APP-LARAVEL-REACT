<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use PhpParser\Node\Stmt\TryCatch;

class StudentController extends Controller
{
    public function store(StudentRequest $request): JsonResponse
    {
        $formData = $request->validated();
        /* if (!$validate) {
            return response()->json([
                'errors' => $validate->errors(),
            ], 422);
        }

        $student = new Student();
        $student->name = $request->input("name");
        $student->course = $request->input("course");
        $student->email = $request->input("email");
        $student->phone = $request->input("phone");
        $student->save(); */
        try {
            Student::create($formData);
            return response()->json([
                'status' => 200,
                'message' => 'Student Add Successfully .'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'status' => 422,
                'error' => $err
            ]);
        }
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return StudentResource::collection(Student::all());
        return response()->json(Student::all());
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully.'], 200);
        }
        return response()->json(['message' => 'Student not found.'], 404);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $student = Student::find($request->id);
        $student->name = $request->input("name");
        $student->course = $request->input("course");
        $student->email = $request->input("email");
        $student->phone = $request->input("phone");
        $student->save();
        return response()->json([
            'status' => 200,
            'message' => 'Student success, Student updated successfully'
        ]);
    }
}
