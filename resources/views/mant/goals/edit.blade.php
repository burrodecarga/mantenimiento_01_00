<x-app-layout>
    <div class="container my-4 mx-auto">
        <form action="{{ route('goals.update',$goal->id) }}" method="POST" class="max-w-md mx-auto">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ __('Modificacion de posición') }}</h1>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('position') }}" for="position" />
                            <x-jet-input type="text" name="position" class="w-full "
                                placeholder="{{ __('input position') }}" value="{{ old('position', $goal->position) }}" />
                            <x-jet-input-error for="position" />
                        </div>

                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('priority') }}" for="priority" />
                            <x-jet-input type="text" name="priority" class="w-full "
                                placeholder="{{ __('input priority') }}" value="{{ old('priority', $goal->priority) }}" />
                            <x-jet-input-error for="priority" />
                        </div>
                        <div class="mb-1 col-span-2">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('restriction') }}" for="restriction" />
                            <select name="restriction" class=" rounded w-full">
                                <option value="">Select a restriction</option>
                                @foreach ($protocols as $p )
                                    <option value="{{ $p->id }}" @if($p->id==$goal->restriction) selected @endif>{{ $p->task }}</option>
                                @endforeach
                            </select>
                        </div>



                            <a type="button" href="{{ route('goals.positions',$goal->id) }}"
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
