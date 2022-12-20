<x-app-layout>
    <div class="container mx-auto my-6">
        <div class="card">
            <div class="card-body">
                <div class="card-body">
                    <h1 class="w-full text-center text-mono font-bold bg-slate-400 mb-2 py-2 uppercase font-gray-500">{{ __('add resources to scheduled task') }}</h1>
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        @livewire('mant.timelines.timeline-observation', ['timeline' => $timeline])
                    </div>

                    <div class="col-span-1">
                        @livewire('mant.timelines.timeline-replacement', ['timeline' => $timeline])
                    </div>
                    <div class="col-span-1">
                        @livewire('mant.timelines.timeline-supply', ['timeline' => $timeline])

                    </div>
                    <div class="col-span-1">
                        @livewire('mant.timelines.timeline-service', ['timeline' => $timeline])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto my-6">
        <div class="card">
            <div class="card-body">
                <h1 class="w-full text-center text-mono font-bold bg-slate-400 mb-2 py-2 uppercase font-gray-500">{{ __('scheduled task images') }}</h1>
                <div class="grid grid-cols-5 gap-4">
                    <div class="col-span-3">
                        @livewire('mant.timelines.timeline-image', ['timeline' => $timeline])
                    </div>
                    <div class="col-span-2">
                        @livewire('mant.timelines.timeline-images', ['timeline' => $timeline])
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mx-auto my-6">
        <div class="card">
            <div class="card-body">
                <div class="card-body">
                    <h1 class="w-full text-center text-mono font-bold bg-slate-400 mb-2 py-2 uppercase font-gray-500">{{ __('resources used in scheduled task') }}</h1>
                <div class="grid grid-cols-3 gap-4">
                    <div class="">
                        @livewire('mant.timelines.timeline-replacement-list', ['timeline' => $timeline])
                    </div>
                    <div class="">
                        @livewire('mant.timelines.timeline-supply-list', ['timeline' => $timeline])
                    </div>
                    <div class="">
                        @livewire('mant.timelines.timeline-service-list', ['timeline' => $timeline])
                    </div>
                </div>
            </div>
        </div>
    </div>
 

    <div class="container mx-auto my-6">
        <div class="card">
            <div class="card-body">
                <h1 class="w-full text-center text-mono font-bold bg-slate-400 mb-2 py-2 uppercase font-gray-500">{{ __('final scheduled task report') }}</h1>
                <div class="grid grid-cols-2 gap-4">
                    <div class="">
                        @livewire('mant.timelines.timeline-comment-list', ['timeline' => $timeline])
                    </div>
                    <div class="bg-gray-100">
                        <h1 class="text-xl font-bold text-gray-500">Finalizar Tarea</h1>
                        <hr class="mt-2 mb-3">
                        <div class="">
                            <form method="POST" action="{{ route('timelines.despeje',$timeline->id) }}" class="p-2 text-sm">
                                @method('post')
                                @csrf
                                <div class=" ml-2 w-full">
                                    <x-jet-input-error for="users" />
                                    @foreach ($team->users as $t)
                                        <div class="flex justify-start items-center gap-3">
                                            <input type="checkbox" value="{{ $t->id }}" name="users[]">
                                            <label>{{ $t->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-blue mt-2 ml-2">Tarea Ejecutada</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

</x-app-layout>
