<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  public function index()
  {
    $students = Student::paginate(5);
    return response()->json($students);
    /* return StudentResource::collection(Student::paginate(10)); */
  }

  public function store(StudentRequest $request)
  {
    $student = Student::create($request->validated());
    return new StudentResource($student);
  }

  public function show(Student $student)
  {
    return new StudentResource($student);
  }

  public function update(StudentRequest $request, Student $student)
  {
    $student->update($request->validated());
    return new StudentResource($student);
  }

  public function destroy(Student $student)
  {
    $student->delete();
    return response()->json(['message' => 'data deleted'], 200);
  }
}
