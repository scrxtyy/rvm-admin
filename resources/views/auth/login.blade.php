<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

       
        <form method="POST" action="{{ route('login') }}">
            {!! csrf_field() !!}
            <div class="grid gap-6">
                <!-- Email Address -->
                <div class="space-y-2">
                    <x-label for="email" :value="__('Email')" />

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="email" class="block w-full text-gray-900" type="email" name="email"
                            :value="old('email')" placeholder="{{ __('Email') }}" required autofocus />
       
                    </x-input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-label for="password" :value="__('Password')" />

                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-input withicon id="password" class="block w-full" type="password" name="password" required
                            autocomplete="current-password" placeholder="{{ __('Password') }}" />                      
                            {{-- <input type="checkbox" class="" id="togglePassword"> --}}
                            {{-- <i class="far fa-eye" id="togglePassword" style="margin-right: -30px; cursor: pointer;"></i> --}}
                    </x-input-with-icon-wrapper>
                   
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="togglePassword" class="inline-flex items-center">
                        <input id="togglePassword" type="checkbox"
                            class="text-green-500 border-gray-300 rounded focus:border-green-300 focus:ring focus:ring-green-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1"
                            name="showPW">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Show Password') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>

                <div>
                    <x-button class="justify-center w-full gap-2">
                        <x-heroicon-o-login class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Log in') }}</span>
                    </x-button>
                </div>

                {{-- @if (Route::has('register'))
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Don’t have an account?') }}
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">
                        {{ __('Register') }}
                    </a>
                </p>
                @endif --}}
            </div>
        </form>
        <script>
            window.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector("#togglePassword");

            togglePassword.addEventListener("click", function (e) {
                const type =
                password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
            });
            });

        </script>
    </x-auth-card>
</x-guest-layout>