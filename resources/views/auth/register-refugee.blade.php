<x-app-layout>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form class="container m-auto" method="post" action="{{route('register.refugee', ['locale' => app()->getLocale()])}}">
        @csrf

        <div class='row g-2' id="refugee-register-step-1">
            <h4 class="text-center">{{__('register.refugee_registration')}}</h4>

            <!-- Required fields -->
            <h5  class="mt-3">{{__('register.required_data')}}</h5>

            <!-- Email -->
            <div class="col-12">
                <input type="email" class="form-control" name="email" placeholder="{{__('register.mail')}}" required>
            </div>

            <!-- Password -->
            <div class="col-12">
                <input type="password" class="form-control" name="password" placeholder="{{__('register.password')}}" required minlength="8">
            </div>

            <!-- Password confirmation -->
            <div class="col-12">
                <input type="password" class="form-control" name="password_confirmation" placeholder="{{__('register.password_confirmation')}}" required >
            </div>

            <!-- Age -->
            <div class="col-4">
                <input type="number" class="form-control" name="refugee_age" placeholder="{{__('register.age')}}" required minlength="8">
            </div>

            <!-- Gender -->
            <div class="form-check col-4">
                <input class="form-check-input" type="radio" name="refugee_gender" id="gender-male" value="M" >
                <label class="form-check-label" for="gender-male">
                    {{__('register.male')}}
                </label>
            </div>
            <div class="form-check col-4">
                <input class="form-check-input" type="radio" name="refugee_gender" id="gender-female" value="F" checked>
                <label class="form-check-label" for="gender-female">
                    {{__('register.female')}}
                </label>
            </div>

            <!-- Place of departure -->
            <div class="col-12">
                <select id="place-of-departure" class="js-example-placeholder-single js-states form-control" name="place_of_departure" required>
                    <option></option>
                    @isset($placesOfDeparture)
                        @foreach($placesOfDeparture AS $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <!-- Optional fields -->
            <h5 class="mt-3">{{__('register.optional_data')}}</h5>

            <!-- First name -->
            <div class="col-6">
                <input type="text" class="form-control" name="first_name" placeholder="{{__('register.first_name')}}">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="last_name" placeholder="{{__('register.last_name')}}">
            </div>

            <!-- Last name -->
            <div class="col-12">
                <textarea class="form-control" name=note placeholder="{{__('register.note')}}" id="notes"></textarea>
            </div>

            <!-- Phone -->
            <div class="col-12">
                <input type="tel" class="form-control" name="phone" onChange="enableSocials(this);" placeholder="{{__('register.phone')}}">
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

            <!-- Refugee companions -->
            <div class="members-of-group">
                <h5 >{{__('register.member_of_group')}}</h5>

                <!-- Warning too many members -->
                <div id="too-many-members-info" class="alert alert-warning collapse">
                    {{__('register.too_many_members_of_group')}}
                </div>

                <div class="member row g-3 mt-1">

                    <!-- Companion Age -->
                    <div class="col-4 col-sm-3">
                        <input type="number" class="form-control" name="age[]" placeholder="{{__('register.age')}}">
                    </div>

                    <!-- Companion Gender -->
                    <div class="col-4 col-sm-3">
                        <select name="gender[]" class="form-control">
                            <option value="M">{{__('register.male')}}</option>
                            <option value="F">{{__('register.female')}}</option>
                        </select>
                    </div>

                    <!-- Remove companion -->
                    <div class="col-4 col-sm-3">
                        <button type="button" class="btn btn-danger w-100"
                                onclick="removeMember(this);">{{__('register.remove_another_member')}}</button>
                    </div>

                    <!-- Add companion -->
                    <div class="col-12 col-sm-3">
                        <button type="button" class="btn btn-success w-100"
                                onclick="addMember(this);">{{__('register.add_another_member')}}</button>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <x-button>
                    {{__('register.submit_register')}}
                </x-button>
            </div>
        </div>
    </form>

    <!-- Scripts -->
    <script>

        $(document).ready(function() {
            $('#place-of-departure').select2({
                placeholder: "{!! __('register.place_of_departure') !!}",
                tags: true
            });
        });

        function enableSocials(el) {
            if($(el).val() != "") {
                $(".enable-socials").removeAttr("disabled");
            } else {
                $(".enable-socials").attr("disabled",true);
                $(".enable-socials").prop("checked",false);
            }
        }

        function addMember(el) {
            var member = $(el).closest(".member").clone();
            member.find('[name="age[]"]').val("");
            member.insertAfter($(el).closest(".member"));
            if($(".member").length >= 3) {
                $("#too-many-members-info").show();
            } else {
                $("#too-many-members-info").hide();
            }
        }
        function removeMember(el) {
            if($(".member").length > 1) {
                $(el).closest(".member").remove();
            }

            if($(".member").length >= 3) {
                $("#too-many-members-info").show();
            } else {
                $("#too-many-members-info").hide();
            }
        }
    </script>
</x-app-layout>
