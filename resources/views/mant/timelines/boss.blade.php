<x-app-layout>
    <div class="container">
        <div class="card mx-auto max-w-md my-8">
            <div class="card-body">
                <img src="{{ asset('form/form2.jpg') }}" alt="agregar sistema"
                    class="max-h-16 w-full object-cover object-center">
                <h1
                    class="text-gray-500 font-bold text-2xl px-3 py-2 w-full bg-slate-100 font-mono text-center uppercase">
                    {{ $timeline->task }}</h1>

                <form action="{{ route('timelines.worker',$timeline->id) }}" method="post" class="form-horizontal">
                    @csrf
                    @method('POST')
                    <div class="mb-6">
                         <x-jet-label class="italic my-2 capitalize" value="{{ __('Seleccione responsable') }}"
                    for="rest_time" />
                    <select name="workers_id" class="w-full rounded">
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->bossName() }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="">
                        <a type="button" href="{{ route('timelines.pending') }}"
                                class="bg-yellow-500 text-white hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('cancel') }}
                            </a>

                            <button type="submit"
                                class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('create') }}
                            </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
