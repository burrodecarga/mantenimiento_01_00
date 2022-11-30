<x-app-layout>
    <div class="container my-4">
        <form action="{{ route('services.store') }}" method="POST" class="max-w-4xl mx-auto rounded-lg shadow-lg">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ __($title) }}</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('name') }}" for="name" />
                            <x-jet-input type="text" name="name" class="w-full "
                                placeholder="{{ __('input name') }}" value="{{ old('name', $service->name) }}" />
                            <x-jet-input-error for="name" />
                        </div>

                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('supply') }}" for="supply" />
                            <x-jet-input type="text" name="supply" class="w-full "
                                placeholder="{{ __('input supply') }}" value="{{ old('supply', $service->supply) }}" />
                            <x-jet-input-error for="supply" />
                        </div>


                            <div class="mb-4">
                                <x-jet-label class="italic my-2 capitalize" value="{{ __('price') }}"
                                    for="price" />
                                <x-jet-input type="text" name="price" class="w-full "
                                    placeholder="{{ __('input price') }}"
                                    value="{{ old('price', $service->price) }}" />
                                <x-jet-input-error for="price" />
                            </div>


                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('description') }}"
                                for="description" />
                                <textarea name="description" class="w-full rounded">{{ old('description', $service->description) }}</textarea>
                        </div>

                        <div>


                        <a type="button" href="{{ route('services.index') }}"
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
    </div>
    </form>
    </div>
</x-app-layout>
