<x-app-layout>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form class='container m-auto row g-2' method="post">
        @csrf

        <h4 class="text-center">Nabidka ubytovani</h4>

        <!-- Required fields -->
        <h5>{{__('register.required_data')}}</h5>

        <!-- Email -->
        <div class="col-12">
            <input type="email" class="form-control" name="email" placeholder="{{__('register.mail')}}" required>
        </div>

        <!-- Password -->
        <div class="col-12">
            <input type="password" class="form-control" name="password" placeholder="{{__('register.password')}}" required>
        </div>

        <!-- Password confirmation -->
        <div class="col-12">
            <input type="password" class="form-control" name="password_confirmation" placeholder="{{__('register.password_confirmation')}}" required >
        </div>

        <!-- Gender -->
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

        <!-- Capacity -->
        <div class="col-12">
            <input type="number" class="form-control" name="seats" placeholder="Kapacita" required>
        </div>
        <div class="form-check col-12">
            <input class="form-check-input" type="checkbox" id="confirmation-of-free-service-cb" required>
            <label class="form-check-label" for="confirmation-of-free-service-cb">
                {{__('register.driver_register_agreement')}}
            </label>
        </div>

        <!-- Housing type -->
        <div class="col-12">
            <select class="form-select" name="car_type">
                <option selected>Typ ubytovani</option>
                <option>Byt</option>
                <option>Mistnost</option>
                <option>Pozemek</option>
                <option>Dum</option>
            </select>
        </div>

        <!-- City -->
        <div class="col-6">
            <input type="text" class="form-control" name="car_color" placeholder="{{__('register.city')}}">
        </div>

        <!-- Country -->
        <div class="col-6">
            <input type="text" class="form-control" name="car_color" placeholder="{{__('register.country')}}">
        </div>

        <!-- Note -->
        <div class="col-12">
            <textarea  class="form-control" name="note" placeholder="Poznamka"></textarea>
        </div>

        <!-- Optional fields -->
        <h5>{{__('register.optional_data')}}</h5>

        <!-- First name -->
        <div class="col-6">
            <input type="text" class="form-control" name="first_name" placeholder="{{__('register.first_name')}}" required>
        </div>

        <!-- Last name -->
        <div class="col-6">
            <input type="text" class="form-control" name="last_name" placeholder="{{__('register.last_name')}}" required>
        </div>

        <!-- Phone -->
        <div class="col-12">
            <input type="tel" class="form-control" onChange="enableSocials(this);"  name="phone" placeholder="{{__('register.phone')}}">
        </div>

        <!-- Facebook/Messenger -->
        <div class="col-12">
            <input type="text" class="form-control" name="facebook" placeholder="Facebook/Messenger">
        </div>

        <!-- Twitter -->
        <div class="col-12">
            <input type="text" class="form-control" name="twitter" placeholder="Twitter">
        </div>

        <!-- WhatsApp -->
        <div class="form-check col-6">
            <input class="form-check-input enable-socials" type="checkbox" value="1" id="whatsapp-cb" disabled>
            <label class="form-check-label" for="whatsapp-cb">
                WhatsApp
            </label>
        </div>

        <!-- Signal -->
        <div class="form-check col-6">
            <input class="form-check-input enable-socials" type="checkbox" value="1" id="signal-cb" disabled>
            <label class="form-check-label" for="signal-cb">
                Signal
            </label>
        </div>

        <!-- Telegram -->
        <div class="form-check col-6">
            <input class="form-check-input enable-socials" type="checkbox" value="1" id="telegram-cb" disabled>
            <label class="form-check-label" for="telegram-cb">
                Telegram
            </label>
        </div>

        <p>Na teto funkci pracujeme.</p>

        <div class="col-12">
            <button class="btn btn-primary w-100" disabled>
                {{__('register.submit_register')}}
            </button>
        </div>
    </form>

    <!-- Scripts -->
    <script>
        function enableSocials(el) {
            if($(el).val() != "") {
                $(".enable-socials").removeAttr("disabled");
            } else {
                $(".enable-socials").attr("disabled",true);
                $(".enable-socials").prop("checked",false);
            }
        }
    </script>
</x-app-layout>
