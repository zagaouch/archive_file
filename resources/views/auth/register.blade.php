<x-guest-layout>
    <div class="w-full sm:max-w-md mx-auto mt-12 px-6 py-8 bg-white shadow-md overflow-hidden rounded-lg border border-[#FDEEEF]">
        <h2 class="text-2xl font-semibold text-center text-[#F06292] mb-6">Create an Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-[#F06292]" />
                <x-text-input id="name" class="block mt-1 w-full border-pink-300 focus:border-[#F06292] focus:ring-[#F06292]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-[#F06292]" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-[#F06292]" />
                <x-text-input id="email" class="block mt-1 w-full border-pink-300 focus:border-[#F06292] focus:ring-[#F06292]" type="email" name="email" :value="old('email')" required autocomplete="username" />
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

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-[#F06292] hover:text-pink-700" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-3 bg-[#F06292] hover:bg-pink-600">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
