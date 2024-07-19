<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return StudentResource::collection($students);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $students = Student::where('first_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->paginate();

        return StudentResource::collection($students);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
        ]);
        $student = Student::create($validated);

        return new StudentResource($student);
    }
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
        ]);
        $student = Student::findOrFail($id);

        $student->update($validated);

        return new StudentResource($student);
    }
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
    }
}
