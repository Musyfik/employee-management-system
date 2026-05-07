@extends('layouts.app')

@section('title', 'Edit Employee — Employee Management System')
@section('page-title', 'Edit Employee')
@section('page-subtitle', 'Update employee information')

@section('content')
<div class="max-w-3xl">

    <form method="POST" action="{{ route('employees.update', $employee) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Photo Upload Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Profile Photo</h3>
            <div class="flex items-center gap-5">
                <div class="relative">
                    <img
                        id="photo-preview"
                        src="{{ $employee->photo_url }}"
                        alt="{{ $employee->full_name }}"
                        class="w-20 h-20 rounded-full object-cover ring-4 ring-slate-100"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($employee->full_name) }}&background=e2e8f0&color=64748b&size=80'"
                    >
                    <label for="photo-input" class="absolute -bottom-1 -right-1 w-7 h-7 bg-blue-600 rounded-full flex items-center justify-center cursor-pointer hover:bg-blue-700 transition-colors shadow-md">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </label>
                </div>
                <div>
                    <input type="file" id="photo-input" name="photo" accept="image/*" class="hidden">
                    <label for="photo-input" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 border border-slate-200 text-slate-600 rounded-lg text-sm hover:bg-slate-50 transition-colors font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Change Photo
                    </label>
                    <p class="text-slate-400 text-xs mt-1.5">Leave empty to keep current photo.</p>
                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Personal Info -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Personal Information</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- Full Name -->
                <div class="sm:col-span-2">
                    <label for="full_name" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="{{ old('full_name', $employee->full_name) }}"
                        placeholder="Enter full name"
                        class="w-full px-4 py-2.5 border {{ $errors->has('full_name') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                    @error('full_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $employee->email) }}"
                        placeholder="employee@company.com"
                        class="w-full px-4 py-2.5 border {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="phone_number"
                        name="phone_number"
                        value="{{ old('phone_number', $employee->phone_number) }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full px-4 py-2.5 border {{ $errors->has('phone_number') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="sm:col-span-2">
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Address <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter full address"
                        class="w-full px-4 py-2.5 border {{ $errors->has('address') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                    >{{ old('address', $employee->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Work Info -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Work Information</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- Division -->
                <div>
                    <label for="division_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Division <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="division_id"
                        name="division_id"
                        class="w-full px-4 py-2.5 border {{ $errors->has('division_id') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ old('division_id', $employee->division_id) == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('division_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Position <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="position"
                        name="position"
                        value="{{ old('position', $employee->position) }}"
                        placeholder="e.g. Software Engineer"
                        class="w-full px-4 py-2.5 border {{ $errors->has('position') ? 'border-red-400 bg-red-50' : 'border-slate-200' }} rounded-xl text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                    @error('position')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center gap-3">
            <button type="submit" id="update-btn" class="flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update Employee
            </button>
            <a href="{{ route('employees.show', $employee) }}" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-50 transition-colors">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection
