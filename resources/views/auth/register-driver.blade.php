<x-app-layout>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form class='container m-auto row g-2'  method="POST" action="{{route('register.driver', ['locale' => app()->getLocale()])}}">
        @csrf
        <h4 class="text-center">{{__('register.driver_register')}}</h4>

        <h5>{{__('register.required_data')}}</h5>
        </div>
        <div class="col-12">
            <input type="email" class="form-control" name="email" placeholder="{{__('register.mail')}}" required>
        </div>
        <div class="col-12">
            <input type="password" class="form-control" name="password" placeholder="{{__('register.password')}}" required minlength="8">
        </div>
        <div class="col-12">
            <input type="password" class="form-control" name="password_confirmation" placeholder="{{__('register.password_confirmation')}}" required >
        </div>
        <div class="form-check col-6">
            <input class="form-check-input" type="radio" name="gender" id="gender-male" value="M" checked>
            <label class="form-check-label" for="gender-male">
                {{__('register.male')}}
            </label>
        </div>
        <div class="form-check col-6">
            <input class="form-check-input" type="radio" name="gender" id="gender-female" value="F">
            <label class="form-check-label" for="gender-female">
                {{__('register.female')}}
            </label>
        </div>
        <div class="col-6">
            <input type="number" class="form-control" name="seats" placeholder="{{__('register.seats')}}" required>
        </div>
        <div class="col-6">
            <input type="number" class="form-control" name="child_seats" placeholder="{{__('register.child_seats')}}" required>
        </div>
        <div class="form-check col-12">
            <input class="form-check-input" name="'confirmation-of-free-service-cb" type="checkbox" id="confirmation-of-free-service-cb" value="1" required>
            <label class="form-check-label" for="confirmation-of-free-service-cb">
                {{__('register.driver_register_agreement')}}
            </label>
        </div>
        <h5>{{__('register.optional_data')}}</h5>
        <div class="col-6 mb-2">
            <input type="text" class="form-control" name="first_name" placeholder="{{__('register.first_name')}}">
        </div>
        <div class="col-6 mb-2">
            <input type="text" class="form-control" name="last_name" placeholder="{{__('register.last_name')}}">
        </div>

        <select class="js-example-basic-single" name="car_type">
            <option selected>{{__('register.car_type')}}</option>
            @foreach(trans('car_types') AS $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>

        <div class="col-6">
            <input type="text" class="form-control" name="car_color" placeholder="{{__('register.car_color')}}">
        </div>
        <div class="col-6">
            <input type="text" class="form-control" name="spz" placeholder="{{__('register.car_spz')}}">
        </div>

        <div class="col-12">
            <textarea class="form-control" placeholder="{{__('register.driver_note')}}" id="notes"></textarea>
        </div>

        <div class="col-6">
            <input type="text" class="form-control" name="city" placeholder="{{__('register.city')}}">
        </div>
        <div class="col-6">
            <input type="text" class="form-control" name="country" placeholder="{{__('register.country')}}">
        </div>
        <div class="col-12">
            <input type="tel" class="form-control" onChange="enableSocials(this);"  name="phone" placeholder="{{__('register.phone')}}">
        </div>
        <div class="col-12">
            <input type="text" class="form-control" name="facebook" placeholder="Facebook/Messenger">
        </div>
        <div class="col-12">
            <input type="text" class="form-control" name="twitter" placeholder="Twitter">
        </div>
        <div class="form-check col-6">
            <input class="form-check-input enable-socials" type="checkbox" value="1" id="whatsapp-cb" disabled>
            <label class="form-check-label" for="whatsapp-cb">
                WhatsApp
            </label>
        </div>
        <div class="form-check col-6">
            <input class="form-check-input enable-socials" type="checkbox" value="1" id="signal-cb" disabled>
            <label class="form-check-label" for="signal-cb">
                Signal
            </label>
        </div>
        <div class="form-check col-6">
            <input class="form-check-input enable-socials" type="checkbox" value="1" id="telegram-cb" disabled>
            <label class="form-check-label" for="telegram-cb">
                Telegram
            </label>
        </div>
        <div class="col-12">
            <x-button>
                {{__('register.submit_register')}}
            </x-button>
        </div>
    </form>

    <script>

        function enableSocials(el) {
            if($(el).val() != "") {
                $(".enable-socials").removeAttr("disabled");
            } else {
                $(".enable-socials").attr("disabled",true);
                $(".enable-socials").prop("checked",false);
            }
        }

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
</x-app-layout>
