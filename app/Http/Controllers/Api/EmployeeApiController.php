<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmployeeApiController extends Controller
{
    /**
     * GET /api/employees
     * List all employees with optional search and filter
     */
    public function index(Request $request): JsonResponse
    {
        $query = Employee::with('division');

        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        $employees = $query->latest()->paginate(10);

        $data = $employees->map(function ($employee) {
            return [
                'id'           => $employee->id,
                'full_name'    => $employee->full_name,
                'email'        => $employee->email,
                'phone_number' => $employee->phone_number,
                'division'     => $employee->division?->name,
                'position'     => $employee->position,
                'address'      => $employee->address,
                'photo_url'    => $employee->photo_url,
                'created_at'   => $employee->created_at->toIso8601String(),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Employees retrieved successfully',
            'data'    => $data,
            'meta'    => [
                'total'        => $employees->total(),
                'per_page'     => $employees->perPage(),
                'current_page' => $employees->currentPage(),
                'last_page'    => $employees->lastPage(),
            ],
        ]);
    }

    /**
     * POST /api/employees
     * Create a new employee
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'unique:employees,email'],
            'phone_number' => ['required', 'string', 'unique:employees,phone_number'],
            'division_id'  => ['required', 'exists:divisions,id'],
            'position'     => ['required', 'string', 'max:255'],
            'address'      => ['required', 'string'],
            'photo'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('employees', 'public');
        }

        $employee = Employee::create($validated);
        $employee->load('division');

        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully',
            'data'    => [
                'id'           => $employee->id,
                'full_name'    => $employee->full_name,
                'email'        => $employee->email,
                'phone_number' => $employee->phone_number,
                'division'     => $employee->division?->name,
                'position'     => $employee->position,
                'address'      => $employee->address,
                'photo_url'    => $employee->photo_url,
                'created_at'   => $employee->created_at->toIso8601String(),
            ],
        ], 201);
    }
}
