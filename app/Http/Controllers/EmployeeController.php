<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees =  Employee::all();
        return response()->json(['success' => true, 'data' => $employees], 200);
    }

    public function store(Request $request)
    {
        logger("ASdf", [$request->all()]);
        $request->validate([
            'name' => 'required|string|min:3|max:25',
            'gender' => 'required|string|in:male,female',
            'department' => 'required|string|in:IT,HR,admin',
            'education' => 'required|string',
            'salary' => 'nullable|in:Less than 1L,1 to 3L,More than 3L',
            'hobbies' => 'array',
            'dob' => 'nullable|date',
        ]);

        Employee::create($request->all());

        return response()->json(['success' => true, 'message' => "Employee Added Successfully."], 201);
    }

    public function show(Employee $employee)
    {
        return $employee;
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:25',
            'gender' => 'required|string|in:male,female',
            'department' => 'required|string|in:IT,HR,admin',
            'education' => 'required|string',
            'salary' => 'nullable|in:Less than 1L,1 to 3L,More than 3L',
            'hobbies' => 'array',
            'dob' => 'nullable|date',
        ]);

        $employee->update($request->all());
        return $employee;
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
