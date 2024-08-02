<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Traits\HandlesCrud;

class StudentController extends Controller
{
    use HandlesCrud;

    public function model()
    {
        return Student::class;
    }
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
        ];
    }
    public function resource()
    {
        return StudentResource::class;
    }
}