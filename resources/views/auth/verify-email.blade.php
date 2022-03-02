<x-app-layout>
    <div class='container m-auto row g-2'>
        <p class="mb-4 text-center">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
            <p class="mb-4 text-center">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </p>
        @endif

        <form  class='col-12'  method="POST" action="{{ route('verification.send',['locale' => app()->getLocale()]) }}">
            @csrf
            <x-button>
                {{ __('Resend Verification Email') }}
            </x-button>
        </form>

        <form class='col-12' method="POST" action="{{ route('logout',['locale' => app()->getLocale()]) }}">
            @csrf
            <x-button>
                {{ __('Log Out') }}
            </x-button>
        </form>
    </div>
</x-app-layout>
