<x-app-layout>
    <div class="container">
        <div class="card mx-auto max-w-md my-8">
            <div class="card-body">
                <form action="{{ route('timelines.worker',$timeline->id) }}" method="post" class="form-horizontal">
                    @csrf
                    @method('POST')
                    <h1 class="text-center font-bold text-gray-500 uppercase my-2">{{ $timeline->task }}</h1>
                    <div class="mb-6">
                         <x-jet-label class="italic my-2 capitalize" value="{{ __('Seleccione responsable') }}"
                    for="rest_time" />
                    <select name="workers_id" class="w-full rounded">
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->user->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="">
                        <a type="button" href="{{ route('plans.index') }}"
                                class="bg-yellow-500 text-white hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('cancel') }}
                            </a>

                            <button type="submit"
                                class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('submit') }}
                            </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
