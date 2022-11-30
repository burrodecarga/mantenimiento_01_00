<x-app-layout>
    <div class="container my-4">
        <form action="{{ route('equipments.store') }}" method="POST" class="max-w-2xl mx-auto rounded-lg shadow-lg">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ __($title) }}</h1>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('prototype') }}" for="name" />
                            <select name="prototype_id" class="w-full rounded-lg text-xs" id="prototype_id">
                                @foreach ($prototypes as $prototype)
                                    <option value="{{ $prototype->id }}">{{ $prototype->fullName() }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="prototype_id" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div class="">
                                <x-jet-label class="italic my-2 capitalize" value="{{ __('location') }}"
                                    for="name" />
                                <select name="location" class="w-full rounded-lg">
                                    @foreach ($zones as $zone)
                                        <option value="{{ $zone->name }}">{{ $zone->name }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="location" />
                            </div>

                            <div>
                                <x-jet-label class="italic my-2 capitalize" value="{{ __('service') }}"
                                    for="service" />
                                <select name="service" class="w-full rounded-lg">
                                    @for ($i = 1; $i <= 24; $i++)
                                        <option value="{{ $i }}">{{ $i . ' horas al día' }}</option>
                                    @endfor
                                </select>
                                <x-jet-input-error for="service" />
                            </div>
                        </div>

                        <div class="w-full">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('equipment') }}" for="name" />
                            <x-jet-input type="text" name="name" class="w-full "
                                placeholder="{{ __('input name') }}" value="{{ old('name', $equipment->name) }}" />
                            <x-jet-input-error for="name" />

                            <x-jet-label class="italic my-2 capitalize" value="{{ __('description') }}" for="description" />
                            <textarea name="description" class="w-full rounded">{{ old('description', $equipment->description) }}</textarea>
                            <x-jet-input-error for="description" />
                            <hr class="mb-4">
                            <a type="button" href="{{ route('equipments.index') }}"
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
</x-app-layout>
