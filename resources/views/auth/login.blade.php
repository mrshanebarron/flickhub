@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 pt-16">
    <div class="w-full max-w-sm">
        <div class="bg-surface-900 border border-surface-800 rounded-2xl p-8 shadow-xl">
            <h1 class="font-display text-2xl text-white mb-1">Welcome back</h1>
            <p class="text-sm text-surface-400 mb-6">Sign in to leave reviews and track your watchlist.</p>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-900/30 border border-red-800 rounded-lg text-sm text-red-300">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs text-surface-400 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2.5 bg-surface-800 border border-surface-700 rounded-lg text-sm text-white placeholder-surface-500 focus:border-brand-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs text-surface-400 mb-1.5">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2.5 bg-surface-800 border border-surface-700 rounded-lg text-sm text-white placeholder-surface-500 focus:border-brand-500 focus:outline-none">
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-surface-400">
                        <input type="checkbox" name="remember" class="rounded bg-surface-800 border-surface-600 text-brand-500">
                        Remember me
                    </label>
                </div>
                <button type="submit" class="w-full py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-medium rounded-lg transition-colors">
                    Sign In
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-surface-500">
                Don't have an account? <a href="{{ route('register') }}" class="text-brand-400 hover:text-brand-300">Create one</a>
            </p>
        </div>
    </div>
</div>
@endsection
