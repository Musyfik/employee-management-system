<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Division;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalDivisions = Division::count();

        $divisionStats = Division::withCount('employees')
            ->orderBy('employees_count', 'desc')
            ->get();

        $recentEmployees = Employee::with('division')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalEmployees',
            'totalDivisions',
            'divisionStats',
            'recentEmployees'
        ));
    }
}
