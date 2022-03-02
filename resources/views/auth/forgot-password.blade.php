<x-app-layout>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form class='container m-auto row g-2' method="POST" action="{{ route('password.email',['locale' => app()->getLocale()]) }}">
        <h5 class="text-center">{{__('Forgot Password')}}</h5>
        <p class="mb-4 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>
        @csrf

        <!-- Email Address -->
        <div class="col-12">
            <input type="email" class="form-control" name="email" :value="old('email')"
                   placeholder="{{__('register.mail')}}" required autofocus>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button>
                {{ __('Email Password Reset Link') }}
            </x-button>
        </div>
    </form>
</x-app-layout>
