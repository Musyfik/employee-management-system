<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::with('division');

        // Search by name
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        // Filter by division
        if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        $employees = $query->latest()->paginate(10)->withQueryString();
        $divisions = Division::orderBy('name')->get();

        return view('employees.index', compact('employees', 'divisions'));
    }

    public function create()
    {
        $divisions = Division::orderBy('name')->get();
        return view('employees.create', compact('divisions'));
    }

    public function store(Request $request)
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

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee "' . $validated['full_name'] . '" has been added successfully.');
    }

    public function show(Employee $employee)
    {
        $employee->load('division');
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $divisions = Division::orderBy('name')->get();
        return view('employees.edit', compact('employee', 'divisions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'full_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'unique:employees,email,' . $employee->id],
            'phone_number' => ['required', 'string', 'unique:employees,phone_number,' . $employee->id],
            'division_id'  => ['required', 'exists:divisions,id'],
            'position'     => ['required', 'string', 'max:255'],
            'address'      => ['required', 'string'],
            'photo'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            $validated['photo'] = $request->file('photo')->store('employees', 'public');
        }

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee "' . $employee->full_name . '" has been updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $name = $employee->full_name;

        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee "' . $name . '" has been deleted successfully.');
    }
}
