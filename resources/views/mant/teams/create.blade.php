<x-app-layout>
    <div class="container mx-auto py-6 my-8">
        <form action="{{ route('teams.store') }}" method="POST" class="card max-w-lg mx-auto">
            @csrf
            <div class="card max-w-xl">
                <div class="card-body">
                    <h1 class="card-title">{{ __($title) }}</h1>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div>
                            <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('team name') }}" for="name" />
                            <x-jet-input type="text" name="name" class="w-full "
                                placeholder="{{ __('input team name') }}" value="{{ old('name', $team->name) }}" />
                            <x-jet-input-error for="name" />
                        </div>
                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('boos') }}" for="user_id" />
                            <select name="user_id" class="w-full rounded-lg">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if($user->id==$team->user_id) selected @endif>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="user_id" />
                        </div>
                        </div>

                        <div>
                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('specialty') }}" for="name" />
                            <select name="specialty_id" class="w-full rounded-lg">
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}" @if($specialty->id==$team->specialty_id) selected @endif>{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="specialty_id" />
                        </div>

                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('zone') }}" for="name" />
                            <select name="zone_id[]" class="select w-full rounded-lg" multiple="multiple">
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}" @if($zone->id==$team->zone_id) selected @endif>{{ $zone->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="zone_id" />
                        </div>
                        </div>



                        <div class="mb-4">
                            <a type="button" href="{{ route('teams.index') }}"
                                class="bg-yellow-500 text-white hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('cancel') }}
                            </a>

                            <button type="submit"
                                class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('submit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.select').select2();
});
</script>

    @endpush
</x-app-layout>
