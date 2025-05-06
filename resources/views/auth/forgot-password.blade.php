<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto mt-12 px-6 py-8 bg-white shadow-md overflow-hidden rounded-lg border border-[#FDEEEF]">

        <!-- Logo -->
        

        <h2 class="text-2xl font-semibold text-center text-[#F06292] mb-4">
            {{ __('Forgot Password') }}
        </h2>

        <div class="mb-4 text-sm text-gray-600 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-[#F06292]" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-[#F06292]" />
                <x-text-input id="email" class="block mt-1 w-full border-pink-300 focus:border-[#F06292] focus:ring-[#F06292]" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#F06292]" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="bg-[#F06292] hover:bg-[#EC407A] focus:ring-[#F06292]">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
