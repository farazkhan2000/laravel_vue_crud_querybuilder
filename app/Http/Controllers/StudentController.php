<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudents() {
        $students = DB::table('students')->get();

        return response()->json($students);
    }

    public function getSingleStudent($id) {
        $student = DB::table('students')->find($id);

        return response()->json($student);
    }

    public function addStudent(Request $request) {
        $student = DB::table('students')->insert([
            'name' => $request->name,
            'age' => $request->age,
            'profession' => $request->profession,
        ]);
    
        if ($student) {
            return response()->json(['message' => 'Student added successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to add student'], 500);
        }
    }

    public function updateStudent(Request $request, $id) {
        $student = DB::table('students')->where('id', $id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'profession' => $request->profession,
        ]);
    
        if ($student) {
            return response()->json(['message' => 'Student updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to update student'], 500);
        }
    }

    public function deleteStudent($id) {
        try {
            $student = DB::table('students')->where('id', $id)->delete();
            return response()->json(['message' => 'Student deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete student'], 500);
        }
    }  
}
