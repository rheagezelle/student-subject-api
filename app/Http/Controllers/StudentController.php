<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request) {
        $student = Student::create($request->all());
        return response()->json($student, 201);
    }
}
