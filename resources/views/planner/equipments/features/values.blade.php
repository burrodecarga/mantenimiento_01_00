<x-app-layout>
    <div class="container py-8">
        <form action="{{ route('equipments.storeValues',$equipment) }}" method="post">
            @csrf
            @method('post')
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-gray-500 font-bold">Caracteristicas del Equipo</h1>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach ($values as $f)
                            <div>
                                <x-jet-label class="italic my-2 capitalize" value="{{ $f->resume }}" for="name" />
                                <input type="text" name="{{ $f->id }}" value="{{ $f->pivot->value }}"
                                    class="rounded shadow">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="mb-4">
            <a type="button" href="{{ route('equipments.index') }}"
                class="bg-yellow-500 text-white hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                {{ __('cancel') }}
            </a>

            <button type="submit"
                class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                {{ __('submit') }}
            </button>
        </form>
    </div>

</x-app-layout>
