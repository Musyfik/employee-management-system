@extends('layouts.app')

@section('title', $employee->full_name . ' — Employee Management System')
@section('page-title', 'Employee Detail')
@section('page-subtitle', 'View complete employee information')

@section('content')
<div class="max-w-3xl space-y-5">

    <!-- Profile Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <!-- Banner -->
        <div class="h-24 bg-gradient-to-r from-blue-600 to-indigo-600"></div>

        <!-- Profile Info -->
        <div class="px-6 pb-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-end gap-4 -mt-10 mb-5">
                <img
                    src="{{ $employee->photo_url }}"
                    alt="{{ $employee->full_name }}"
                    class="w-20 h-20 rounded-full object-cover ring-4 ring-white shadow-lg flex-shrink-0"
                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($employee->full_name) }}&background=3b82f6&color=fff&size=80'"
                >
                <div class="pb-1">
                    <h2 class="text-xl font-bold text-slate-800">{{ $employee->full_name }}</h2>
                    <p class="text-slate-500 text-sm">{{ $employee->position }}</p>
                </div>
                <div class="sm:ml-auto flex items-center gap-2">
                    <a href="{{ route('employees.edit', $employee) }}" class="flex items-center gap-1.5 px-4 py-2 border border-slate-200 text-slate-600 rounded-lg text-sm hover:bg-slate-50 transition-colors font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <button
                        type="button"
                        class="flex items-center gap-1.5 px-4 py-2 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm hover:bg-red-100 transition-colors font-medium"
                        data-delete-id="{{ $employee->id }}"
                        data-delete-name="{{ $employee->full_name }}"
                        data-delete-url="{{ route('employees.destroy', $employee) }}"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </div>
            </div>

            <!-- Division Badge -->
            <div class="mb-5">
                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-700">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    {{ $employee->division?->name ?? 'No Division' }}
                </span>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl">
                    <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 font-medium">Email</p>
                        <p class="text-sm text-slate-800 font-medium mt-0.5 break-all">{{ $employee->email }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl">
                    <div class="w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 font-medium">Phone</p>
                        <p class="text-sm text-slate-800 font-medium mt-0.5">{{ $employee->phone_number }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl">
                    <div class="w-9 h-9 bg-violet-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 font-medium">Position</p>
                        <p class="text-sm text-slate-800 font-medium mt-0.5">{{ $employee->position }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl">
                    <div class="w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 font-medium">Joined</p>
                        <p class="text-sm text-slate-800 font-medium mt-0.5">{{ $employee->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl sm:col-span-2">
                    <div class="w-9 h-9 bg-rose-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs text-slate-500 font-medium">Address</p>
                        <p class="text-sm text-slate-800 font-medium mt-0.5">{{ $employee->address }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div>
        <a href="{{ route('employees.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-700 font-medium transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Employees
        </a>
    </div>

</div>
@endsection
