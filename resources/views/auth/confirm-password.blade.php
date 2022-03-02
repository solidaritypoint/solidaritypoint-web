<x-app-layout>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class='container m-auto row g-2'  method="POST" action="{{ route('password.confirm',['locale' => app()->getLocale()]) }}">
            @csrf
            <h5 class="text-center">{{__('Confirm Password')}}</h5>
            <p class="mb-4 text-center">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>

            <!-- Password -->
            <div class="col-12">
                <input type="password" class="form-control" name="password" placeholder="{{__('register.password')}}" required>
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
</x-app-layout>
