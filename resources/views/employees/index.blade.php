@extends('layouts.app')

@section('title', 'Employees — Employee Management System')
@section('page-title', 'Employees')
@section('page-subtitle', 'Manage all your employee records')

@section('content')
<div class="space-y-5">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row gap-3">
        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('employees.index') }}" class="flex flex-1 flex-col sm:flex-row gap-3">
            <!-- Search -->
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    id="search-input"
                    value="{{ request('search') }}"
                    placeholder="Search by name..."
                    class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
                >
            </div>

            <!-- Division Filter -->
            <select
                name="division_id"
                id="division-filter"
                class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm min-w-40"
                onchange="this.form.submit()"
            >
                <option value="">All Divisions</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                        {{ $division->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2.5 bg-slate-700 hover:bg-slate-800 text-white rounded-xl text-sm font-medium transition-colors shadow-sm">
                Search
            </button>

            @if(request('search') || request('division_id'))
                <a href="{{ route('employees.index') }}" class="px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-sm font-medium transition-colors shadow-sm whitespace-nowrap">
                    Clear
                </a>
            @endif
        </form>

        <!-- Add Button -->
        <a href="{{ route('employees.create') }}" id="add-employee-btn" class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Employee
        </a>
    </div>

    <!-- Results Info -->
    @if(request('search') || request('division_id'))
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Found <strong class="text-slate-700">{{ $employees->total() }}</strong> result(s)
            @if(request('search')) for "<strong class="text-slate-700">{{ request('search') }}</strong>"@endif
            @if(request('division_id')) in <strong class="text-slate-700">{{ $divisions->find(request('division_id'))?->name }}</strong>@endif
        </div>
    @endif

    <!-- Employee Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        @if($employees->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/70">
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Employee</th>
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Contact</th>
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Division</th>
                            <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider hidden lg:table-cell">Position</th>
                            <th class="text-right px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($employees as $employee)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <!-- Employee Info -->
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <img
                                            src="{{ $employee->photo_url }}"
                                            alt="{{ $employee->full_name }}"
                                            class="w-10 h-10 rounded-full object-cover flex-shrink-0 ring-2 ring-slate-100"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($employee->full_name) }}&background=3b82f6&color=fff&size=40'"
                                        >
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800">{{ $employee->full_name }}</p>
                                            <p class="text-xs text-slate-400 sm:hidden">{{ $employee->email }}</p>
                                            <p class="text-xs text-slate-400 md:hidden mt-0.5">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">{{ $employee->division?->name }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contact -->
                                <td class="px-5 py-4 hidden sm:table-cell">
                                    <p class="text-sm text-slate-600">{{ $employee->email }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $employee->phone_number }}</p>
                                </td>

                                <!-- Division -->
                                <td class="px-5 py-4 hidden md:table-cell">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ $employee->division?->name }}
                                    </span>
                                </td>

                                <!-- Position -->
                                <td class="px-5 py-4 hidden lg:table-cell">
                                    <p class="text-sm text-slate-600">{{ $employee->position }}</p>
                                </td>

                                <!-- Actions -->
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('employees.show', $employee) }}" class="p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all" title="View">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('employees.edit', $employee) }}" class="p-2 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-all" title="Edit">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <button
                                            type="button"
                                            class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all"
                                            data-delete-id="{{ $employee->id }}"
                                            data-delete-name="{{ $employee->full_name }}"
                                            data-delete-url="{{ route('employees.destroy', $employee) }}"
                                            title="Delete"
                                        >
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($employees->hasPages())
                <div class="px-5 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-xs text-slate-500">
                        Showing {{ $employees->firstItem() }}–{{ $employees->lastItem() }} of {{ $employees->total() }} employees
                    </p>
                    <div class="flex items-center gap-1">
                        {{-- Previous --}}
                        @if($employees->onFirstPage())
                            <span class="px-3 py-1.5 text-xs text-slate-300 border border-slate-100 rounded-lg cursor-not-allowed">← Prev</span>
                        @else
                            <a href="{{ $employees->previousPageUrl() }}" class="px-3 py-1.5 text-xs text-slate-600 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">← Prev</a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach($employees->getUrlRange(max(1, $employees->currentPage() - 2), min($employees->lastPage(), $employees->currentPage() + 2)) as $page => $url)
                            @if($page == $employees->currentPage())
                                <span class="px-3 py-1.5 text-xs font-semibold bg-blue-600 text-white rounded-lg">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1.5 text-xs text-slate-600 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if($employees->hasMorePages())
                            <a href="{{ $employees->nextPageUrl() }}" class="px-3 py-1.5 text-xs text-slate-600 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">Next →</a>
                        @else
                            <span class="px-3 py-1.5 text-xs text-slate-300 border border-slate-100 rounded-lg cursor-not-allowed">Next →</span>
                        @endif
                    </div>
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="text-center py-16 px-5">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-slate-700 font-semibold text-base mb-1">No employees found</h3>
                <p class="text-slate-400 text-sm mb-6">
                    @if(request('search') || request('division_id'))
                        Try adjusting your search or filter criteria.
                    @else
                        Get started by adding your first employee.
                    @endif
                </p>
                @if(!request('search') && !request('division_id'))
                    <a href="{{ route('employees.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add First Employee
                    </a>
                @endif
            </div>
        @endif
    </div>

</div>
@endsection
