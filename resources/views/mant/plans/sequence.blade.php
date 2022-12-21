<x-app-layout>
<div class="container ">
    <div class="card mx-auto my-6 max-w-2xl">
        <div class="card-body">
            <h1 class="text-gray-400 text-center font-bold uppercase">secuencia de tareas </h1>
            <form action="{{ route('plans.sequence_update',$plan->id) }}" method="POST">
                @csrf
                @method('post')
                @foreach($timelines as $t)
<div class="grid grid-cols-6 gap-x-2 items-center">
      <input type="checkbox" name="ids[]" value="{{ $t->equipment_id }}" class="check mx-2" @if($t->sequence==1) checked @endif/>
    <x-jet-label class="col-span-3 italic my-2 capitalize" value="{{ $t->equipment() }}"
    for="name" />
    @if($t->sequence==1)
    <x-jet-label class="col-span-2 italic my-2 capitalize" value="{{ 'inicia: ' .$plan->start->format('d-m-Y h:i A') }}"
        for="name" />
        @else
        <x-jet-label class="col-span-2 italic my-2 capitalize" value="sigue"
            for="name" />
            @endif

</div>

                @endforeach

                <div class="mb-2">
                    <a type="button" href="{{ route('plans.show',$plan->id) }}"
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
