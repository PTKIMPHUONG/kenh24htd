<!-- resources/views/auth/login.blade.php -->
<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
        </div>

        <!-- Remember Me -->
        <div class="form-check mt-4">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <div class="d-flex justify-content-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-primary ms-4">
                {{ __('Log in') }}
            </button>
        </div>

        <div class="google-signin mt-4">
            <a href="{{ route('auth.google') }}">
                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Google Sign In">
            </a>
        </div>
    </form>
</x-guest-layout>
