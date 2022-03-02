<x-app-layout>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update',['locale' => app()->getLocale()]) }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token',['locale' => app()->getLocale()]) }}">

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

            <!-- Confirm Password -->
            <div class="col-12">
                <input type="password" class="form-control" name="password_confirmation" placeholder="{{__('register.password_confirmation')}}" required >
            </div>

            <div class="col-12">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
</x-app-layout>
