<x-app-layout>
    <div class="container my-4">
        <form action="{{ route('features.update',$feature->id) }}" method="POST" class="max-w-2xl mx-auto rounded-lg shadow-lg">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ __($title) }}</h1>
                    <div class="grid  md:grid-cols-2 gap-3">
                        <div class="mb-2 md:mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('measure') }}" for="measure" />
                            <x-jet-input type="text" name="measure" class="w-full "
                                placeholder="{{ __('input measure') }}"
                                value="{{ old('measure', $feature->measure) }}" />
                            <x-jet-input-error for="measure" />
                        </div>
                        <div class="mb-2 md:mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('unit') }}" for="unit" />
                            <x-jet-input type="text" name="unit" class="w-full "
                                placeholder="{{ __('input unit') }}" value="{{ old('unit', $feature->unit) }}" />
                            <x-jet-input-error for="unit" />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-3">
                        <div class="w-full">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('symbol') }}" for="symbol" />
                            <x-jet-input type="text" name="symbol" class="w-full "
                                placeholder="{{ __('input symbol') }}" value="{{ old('symbol', $feature->symbol) }}" />
                            <x-jet-input-error for="symbol" />
                        </div>
                        <div class="w-full text-xs">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('numeric') }}" for="isNumeric" />
                            <select name="isNumeric" class="w-full rounded-lg">
                                <option value="1">Número</option>
                                <option value="0">Texto</option>
                            </select>
                            <x-jet-input-error for="isNumeric" />
                        </div>
                    </div>
                    <textarea name="description" class="w-full my-2 rounded" placeholder="{{ __('description') }}">{{ old('description', $feature->description) }}</textarea>
                    <div class="my-2">
                        <div>
                            <a type="button" href="{{ route('features.index') }}"
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
