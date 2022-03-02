<x-app-layout>

    <div class="container">
        <div class="py-5">
            <h5 class="mt-3 text-center">Akceptované nabídky</h5>

            <x-refugee.offer :offers="$accepted_offers"/>

            <h5 class="mt-3 text-center">Nekaceptované (nové) nabídky</h5>

            <x-refugee.offer :offers="$unaccepted_offers"/>
        </div>
    </div>
</x-app-layout>
