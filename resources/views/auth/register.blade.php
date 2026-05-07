@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <h2 class="text-white text-xl font-bold mb-1">Create account</h2>
    <p class="text-slate-400 text-sm mb-6">Join the Employee Management System</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-slate-300 text-sm font-medium mb-1.5">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="John Doe"
                autocomplete="name"
                class="w-full px-4 py-2.5 bg-white/10 border {{ $errors->has('name') ? 'border-red-500' : 'border-white/20' }} text-white placeholder-slate-500 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            >
            @error('name')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-slate-300 text-sm font-medium mb-1.5">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@company.com"
                autocomplete="email"
                class="w-full px-4 py-2.5 bg-white/10 border {{ $errors->has('email') ? 'border-red-500' : 'border-white/20' }} text-white placeholder-slate-500 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            >
            @error('email')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-slate-300 text-sm font-medium mb-1.5">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Min. 8 characters"
                autocomplete="new-password"
                class="w-full px-4 py-2.5 bg-white/10 border {{ $errors->has('password') ? 'border-red-500' : 'border-white/20' }} text-white placeholder-slate-500 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            >
            @error('password')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-slate-300 text-sm font-medium mb-1.5">Confirm Password</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Repeat password"
                autocomplete="new-password"
                class="w-full px-4 py-2.5 bg-white/10 border border-white/20 text-white placeholder-slate-500 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            >
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm transition-all duration-200 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 active:scale-[0.98]"
        >
            Create Account
        </button>
    </form>

    <p class="text-slate-400 text-sm text-center mt-6">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">Sign in</a>
    </p>
@endsection
