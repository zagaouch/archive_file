<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto mt-12 px-6 py-8 bg-white shadow-md overflow-hidden rounded-lg border border-[#FDEEEF]">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="App Logo" class="w-20 h-20">
        </div>

        <h2 class="text-2xl font-semibold text-center text-[#F06292] mb-4">
            {{ __('Reset Password') }}
        </h2>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-[#F06292]" />
                <x-text-input id="email" class="block mt-1 w-full border-pink-300 focus:border-[#F06292] focus:ring-[#F06292]" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#F06292]" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-[#F06292]" />
                <x-text-input id="password" class="block mt-1 w-full border-pink-300 focus:border-[#F06292] focus:ring-[#F06292]" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#F06292]" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#F06292]" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-pink-300 focus:border-[#F06292] focus:ring-[#F06292]" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[#F06292]" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="bg-[#F06292] hover:bg-[#EC407A] focus:ring-[#F06292]">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
