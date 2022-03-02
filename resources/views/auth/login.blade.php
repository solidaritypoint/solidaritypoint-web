<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

    <form class='container m-auto row g-2' method="POST"
          action="{{ route('login', ['locale' => app()->getLocale()]) }}">
        @csrf

        <h5 class="text-center">{{__('Login')}}</h5>

        <!-- Email Address -->
        <div class="col-12">
            <input type="email" class="form-control" name="email" :value="old('email')"
                   placeholder="{{__('register.mail')}}" required autofocus>
        </div>

        <!-- Password -->
        <div class="col-12">
            <input type="password" class="form-control" name="password" placeholder="{{__('register.password')}}"
                   required autocomplete="current-password">
        </div>

        <!-- Remember Me -->
        <div class="form-check col-12">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label" for="remember_me">
                {{ __('Remember me') }}
            </label>
        </div>

        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('password.request', ['locale' => app()->getLocale()]) }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-app-layout>
