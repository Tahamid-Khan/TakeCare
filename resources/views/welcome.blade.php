<x-guest-layout>

    <x-auth-card>
        <x-slot name="logo">
            <a href="#">
                <img src="{{ asset('img/takecare_logo.png') }}" width="70px">
            </a>
            <h1 style="text-align: center; color: black; margin-top: 10px"><strong>Take Care</strong></h1>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email/Phone')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>

            <!-- Password -->
           <div class="mt-4">
    <x-label for="password" :value="__('Password')" />

    <div class="relative">
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500 focus:outline-none">
            <!-- Eye icon that changes based on password visibility -->
            <svg id="eyeIcon" width="18" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="eyePath" d="M12 6.5c2.76 0 5 2.24 5 5 0 .51-.1 1-.24 1.46l3.06 3.06c1.39-1.23 2.49-2.77 3.18-4.53-1.73-3.89-6-7.5-12-7.5-1.27 0-2.49.2-3.64.57l2.17 2.17c.47-.14.96-.24 1.47-.24zM2.71 3.16c-.39.39-.39 1.02 0 1.41l1.97 1.97C3.06 7.83 1.77 9.53 1 11.5 2.73 15.39 7 19 13 19c1.52 0 2.97-.3 4.31-.82l2.72 2.72c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L4.13 3.16c-.39-.39-1.03-.39-1.42 0zM12 16.5c-2.76 0-5-2.24-5-5 0-.77.18-1.5.49-2.14l1.57 1.57c-.03.18-.06.37-.06.57 0 1.66 1.34 3 3 3 .2 0 .38-.03.57-.07L14.14 16c-.65.32-1.37.5-2.14.5zm2.97-5.33c-.15-1.4-1.25-2.49-2.64-2.64l2.64 2.64z" fill="currentColor"/>
            </svg>
        </button>
    </div>
    <span class="text-danger">{{ $errors->first('password') }}</span>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyePath = document.getElementById('eyePath');
        
        // Eye icon paths
        const eyeVisiblePath = "M12 4.5C6 4.5 1.73 8.11 0 12c1.73 3.89 6 7.5 12 7.5s10.27-3.61 12-7.5c-1.73-3.89-6-7.5-12-7.5zm0 12.5c-2.92 0-5.28-2.35-5.28-5.25S9.08 6.5 12 6.5s5.28 2.35 5.28 5.25S14.92 17 12 17zm0-8c-1.52 0-2.75 1.22-2.75 2.75S10.48 14.5 12 14.5s2.75-1.22 2.75-2.75S13.52 9 12 9zm0 4.5c-.98 0-1.75-.77-1.75-1.75S11.02 10 12 10s1.75.77 1.75 1.75S12.98 13.5 12 13.5z";
        const eyeHiddenPath = "M12 6.5c2.76 0 5 2.24 5 5 0 .51-.1 1-.24 1.46l3.06 3.06c1.39-1.23 2.49-2.77 3.18-4.53-1.73-3.89-6-7.5-12-7.5-1.27 0-2.49.2-3.64.57l2.17 2.17c.47-.14.96-.24 1.47-.24zM2.71 3.16c-.39.39-.39 1.02 0 1.41l1.97 1.97C3.06 7.83 1.77 9.53 1 11.5 2.73 15.39 7 19 13 19c1.52 0 2.97-.3 4.31-.82l2.72 2.72c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L4.13 3.16c-.39-.39-1.03-.39-1.42 0zM12 16.5c-2.76 0-5-2.24-5-5 0-.77.18-1.5.49-2.14l1.57 1.57c-.03.18-.06.37-.06.57 0 1.66 1.34 3 3 3 .2 0 .38-.03.57-.07L14.14 16c-.65.32-1.37.5-2.14.5zm2.97-5.33c-.15-1.4-1.25-2.49-2.64-2.64l2.64 2.64z";
        
        toggleButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyePath.setAttribute('d', eyeVisiblePath);
            } else {
                passwordInput.type = 'password';
                eyePath.setAttribute('d', eyeHiddenPath);
            }
        });
    });
</script>


            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ml-3 btn btn-primary">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
<style>
    /* Card styling */
    .auth-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        max-width: 400px;
        width: 100%;
        margin: 2rem auto;
    }

    /* Logo styling */
    .logo-image {
        display: block;
        margin: 0 auto;
    }

    /* App title */
    .app-title {
        text-align: center;
        color: #0071C1;
        margin-top: 12px;
        font-size: 1.5rem;
        font-weight: 600;
    }

    /* Form inputs */
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 0.65rem 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        font-size: 0.95rem;
        color: #4a5568;
        background-color: #ffffff;
        transition: border-color 0.2s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        border-color: #0071C1;
        box-shadow: 0 0 0 2px rgba(0, 113, 193, 0.1);
        outline: none;
    }

    /* Labels */
    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #2d3748;
        font-size: 0.9rem;
    }

    /* Error messages */
    .text-danger {
        display: block;
        font-size: 0.8rem;
        margin-top: 0.25rem;
        color: #e53e3e;
    }

    /* Checkbox */
    input[type="checkbox"] {
        border-color: #cbd5e0;
    }

    /* Links */
    a {
        color: #4a5568;
        text-decoration: none;
        font-size: 0.875rem;
        transition: color 0.2s ease;
    }

    a:hover {
        color: #0071C1;
        text-decoration: underline;
    }

    /* Button */
    .btn-primary {
        background-color: #0071C1;
        color: white;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 4px;
        border: none;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #005a9e;
    }

    .btn-primary:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 113, 193, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .auth-card {
            margin: 1rem;
            padding: 1.5rem;
        }

        .flex.items-center.justify-end {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .btn-primary {
            margin-left: 0 !important;
            margin-top: 1rem;
            width: 100%;
            text-align: center;
        }
    }
</style>
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var showIcon = document.getElementById("showPasswordIcon");
        var hideIcon = document.getElementById("hidePasswordIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            showIcon.style.display = "none";
            hideIcon.style.display = "block";
        } else {
            passwordField.type = "password";
            showIcon.style.display = "block";
            hideIcon.style.display = "none";
        }
    }
</script>