<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <p class="text-xs uppercase tracking-[0.22em] text-orange-600 text-center mb-2 font-semibold">Secure Sign In</p>
    <h2 class="text-3xl font-bold text-slate-800 mb-5 text-center" style="font-family: 'Playfair Display', serif;">Welcome Back</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-4">
            <x-primary-button class="w-full justify-center !bg-orange-600 hover:!bg-orange-700 focus:!ring-orange-500">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="text-sm text-gray-600 hover:text-pink-600" href="{{ route('register') }}">
                {{ __("Don't have an account?") }}
            </a>

            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-pink-600" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
