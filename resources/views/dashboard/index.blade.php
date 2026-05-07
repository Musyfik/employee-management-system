@extends('layouts.app')

@section('title', 'Dashboard — Employee Management System')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your workforce')

@section('content')
<div class="space-y-6">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <!-- Total Employees -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Total Employees</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalEmployees }}</p>
                    <p class="text-slate-400 text-xs mt-2">Active workforce</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Divisions -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Total Divisions</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalDivisions }}</p>
                    <p class="text-slate-400 text-xs mt-2">Active departments</p>
                </div>
                <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Largest Division -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Largest Division</p>
                    <p class="text-xl font-bold text-slate-800 mt-1 leading-tight">{{ $divisionStats->first()?->name ?? 'N/A' }}</p>
                    <p class="text-slate-400 text-xs mt-2">{{ $divisionStats->first()?->employees_count ?? 0 }} employees</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Avg Per Division -->
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Avg / Division</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">
                        {{ $totalDivisions > 0 ? round($totalEmployees / $totalDivisions, 1) : 0 }}
                    </p>
                    <p class="text-slate-400 text-xs mt-2">Employees per dept</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

        <!-- Division Stats -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-semibold text-slate-800 text-sm">Employees by Division</h3>
                <span class="text-xs text-slate-400">{{ $totalDivisions }} divisions</span>
            </div>
            <div class="space-y-3">
                @forelse($divisionStats as $division)
                    @php
                        $percentage = $totalEmployees > 0 ? ($division->employees_count / $totalEmployees) * 100 : 0;
                        $colors = ['bg-blue-500', 'bg-violet-500', 'bg-emerald-500', 'bg-amber-500', 'bg-red-500', 'bg-cyan-500', 'bg-pink-500', 'bg-indigo-500'];
                        $color = $colors[$loop->index % count($colors)];
                    @endphp
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-slate-700 font-medium">{{ $division->name }}</span>
                            <span class="text-xs text-slate-500">{{ $division->employees_count }} emp</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="{{ $color }} h-full rounded-full transition-all duration-700" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm text-center py-4">No divisions found.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Employees -->
        <div class="lg:col-span-3 bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-semibold text-slate-800 text-sm">Recently Added</h3>
                <a href="{{ route('employees.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium transition-colors">View all →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentEmployees as $employee)
                    <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <img
                            src="{{ $employee->photo_url }}"
                            alt="{{ $employee->full_name }}"
                            class="w-10 h-10 rounded-full object-cover flex-shrink-0 ring-2 ring-slate-100"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($employee->full_name) }}&background=3b82f6&color=fff&size=40'"
                        >
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-800 truncate">{{ $employee->full_name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $employee->position }} · {{ $employee->division?->name }}</p>
                        </div>
                        <span class="text-xs text-slate-400 flex-shrink-0">{{ $employee->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">No employees yet.</p>
                        <a href="{{ route('employees.create') }}" class="text-blue-600 text-sm font-medium hover:underline mt-1 inline-block">Add first employee</a>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-lg">Ready to manage your team?</h3>
                <p class="text-blue-200 text-sm mt-1">Add employees, update records, and keep your workforce organized.</p>
            </div>
            <a href="{{ route('employees.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-white text-blue-700 rounded-xl font-semibold text-sm hover:bg-blue-50 transition-colors flex-shrink-0 shadow-lg shadow-blue-900/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Employee
            </a>
        </div>
    </div>

</div>
@endsection
