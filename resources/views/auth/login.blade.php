@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <h2 class="text-white text-xl font-bold mb-1">Welcome back</h2>
    <p class="text-slate-400 text-sm mb-6">Sign in to your account to continue</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-slate-300 text-sm font-medium mb-1.5">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="admin@company.com"
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
                placeholder="••••••••"
                autocomplete="current-password"
                class="w-full px-4 py-2.5 bg-white/10 border {{ $errors->has('password') ? 'border-red-500' : 'border-white/20' }} text-white placeholder-slate-500 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            >
            @error('password')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/10 text-blue-500 focus:ring-blue-500">
            <label for="remember" class="text-slate-400 text-sm">Remember me</label>
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm transition-all duration-200 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 active:scale-[0.98]"
        >
            Sign In
        </button>

        <!-- Demo Credentials -->
        <div class="bg-white/5 border border-white/10 rounded-lg p-3 text-xs text-slate-400">
            <p class="font-medium text-slate-300 mb-1">Demo Credentials</p>
            <p>Email: <span class="text-blue-400">admin@company.com</span></p>
            <p>Password: <span class="text-blue-400">password</span></p>
        </div>
    </form>

    <p class="text-slate-400 text-sm text-center mt-6">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">Register here</a>
    </p>
@endsection
