@extends('layouts.app') <!-- CHANGED FROM x-guest-layout -->

@section('content')
<div class="w-full sm:max-w-md mx-auto mt-12 px-6 py-8 bg-white shadow-md overflow-hidden rounded-lg border border-[#FDEEEF]">
    <h2 class="text-2xl font-semibold text-center text-[#F06292] mb-6">Login to Archive File</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#F06292]" />
            <x-text-input id="email" class="block mt-1 w-full border-pink-300 focus:border-[#F06292] focus:ring-[#F06292]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#F06292]" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#F06292]" />
            <x-text-input id="password" class="block mt-1 w-full border-pink-300 focus:border-[#F06292] focus:ring-[#F06292]" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#F06292]" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-pink-300 text-[#F06292] shadow-sm focus:ring-[#F06292]" name="remember">
                <span class="ms-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#F06292] hover:text-pink-700" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-[#F06292] hover:bg-pink-600">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
