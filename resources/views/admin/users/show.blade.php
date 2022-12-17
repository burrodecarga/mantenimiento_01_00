<x-app-layout>
    <!-- component -->
<div class="container">
    <div class="card my-6">
        <div class="card-body">
            <div class="grid grid-cols-3 gap-2">
             <figure>
                <img src="{{ $user->profile_photo_url }}" alt="">
             </figure>
             <div class="header col-span-2 text-gray-600">
                <h1 class="font-mono font-bold text-2xl">{{ $user->name }}</h1>
                <h2 class="text-md italic"><strong>{{ __('role') }}:</strong> {{ $user->getRoleNames()->join(', ') }}</h2>
                <h2 class="text-md italic"><strong>{{ __('salary') }}:</strong> {{ price($user->profile->salary) }} $</h2>
                <h2 class="text-md italic"><strong>{{ __('email') }}:</strong> {{ $user->email }}</h2>
                <h2 class="text-md italic"><strong>{{ __('task group') }}:</strong> {{ $user->teams()->first()?->name }}</h2>

                <h2><strong>{{ __('location') }}:</h2>
                <ul class="ml-4 grid grid-cols-3 gap-2">
                  @foreach ($user->teams()->first()->zones as $zone)
                    <li class="w-full bg-slate-100 text-cente px-3 py-2">{{ $zone->name }}</li>
                    @endforeach
                </ul>

             </div>
            </div>
         </div>
    </div>

</div>
</x-app-layout>
