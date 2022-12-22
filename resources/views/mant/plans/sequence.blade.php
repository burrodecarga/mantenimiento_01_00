<x-app-layout>
    <div class="container ">
        <div class="card mx-auto my-6 max-w-2xl">
            <div class="card-body">
                <img src="{{ asset('form/form2.jpg') }}" alt="agregar sistema"
                    class="max-h-16 w-full object-cover object-center">
                <h1
                    class="text-gray-500 font-bold text-2xl px-3 py-2 w-full bg-slate-100 font-mono text-center uppercase">
                    {{ __('task sequence') }}</h1>

                <form class="p-4" action="{{ route('plans.sequence_update', $plan->id) }}" method="POST">
                    @csrf
                    @method('post')
                    @foreach ($timelines as $t)
                        <div class="grid grid-cols-6 gap-x-2 items-center my-2">
                            <input type="checkbox" name="ids[]" value="{{ $t->equipment_id }}" class="check mx-2"
                                @if ($t->sequence == 1) checked @endif />
                            <x-jet-label class="col-span-3 italic my-2 capitalize" value="{{ $t->equipment() }}"
                                for="name" />
                            @if ($t->sequence == 1)
                                <x-jet-label class="col-span-2 italic my-2 capitalize"
                                    value="{{ 'inicia: ' . $plan->start->format('d-m-Y h:i A') }}" for="name" />
                            @else
                                <x-jet-label class="col-span-2 italic my-2 capitalize" value="sigue" for="name" />
                            @endif
                        </div>
                    @endforeach
                    <div class="my-2">
                        <a type="button" href="{{ route('plans.show', $plan->id) }}"
                            class="bg-yellow-500 text-white hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            {{ __('cancel') }}
                        </a>

                        <button type="submit"
                            class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            {{ __('update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
