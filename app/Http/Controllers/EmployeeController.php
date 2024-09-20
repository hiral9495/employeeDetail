<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use DataTables;

class EmployeeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    public function generateCode()
    {
        $nextEmployeeCode = Employee::generateEmployeeCode();
        return response()->json(['employee_code' => $nextEmployeeCode]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'joining_date' => 'nullable|date',
          // 'profile_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
        } else {
            $path = null;
        }

        Employee::create([
            'employee_code' => $request->employee_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'joining_date' => $request->joining_date,
            'profile_image' => $path
        ]);

        return response()->json(['success' => 'Employee created successfully.']);
    }

    public function getEmployees(Request $request)
    {
        $query = Employee::query();

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $query->whereBetween('joining_date', [$request->start_date, $request->end_date]);
        }

        $employees = $query->get();

        return DataTables::of($employees)
            ->addColumn('full_name', function ($employee) {
                return $employee->first_name . ' ' . $employee->last_name;
            })
            ->addColumn('profile_image', function ($employee) {
                if ($employee->profile_image) {
                    $url = asset('storage/' . $employee->profile_image);
                    return "<img src='$url' class='img-thumbnail' width='50' height='50'/>";
                }
            })
            ->rawColumns(['profile_image'])
            ->make(true);
    }

    /**
     * Display the employees list
     */
    public function show()
    {
        return view('show');
    }

}
