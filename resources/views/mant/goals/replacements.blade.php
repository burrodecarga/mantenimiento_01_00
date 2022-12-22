<x-app-layout>
    <div class="container my-6">
        <div class="card">
            <div class="card-body">

                <div class="flex flex items-center justify-around mb-3 bg-slate-50">
                    <div>
                        <h1 class="text-center text-gray-500 text-xl font-bold uppercase">{{ __("add resources") }}</h1>
                        <h2 class="text-center text-gray-500 text-lg font-bold">{{ $goal->equipment().'  '.$goal->task }}</h2>
                    </div>
                    <div class="">
                        <a href="{{ URL::previous() }}"
                        class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                        <i class="fa-sharp fa-solid fa-list-check"></i>
                        {{ __('back') }}
                    </a>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        @livewire('mant.goals.goal-replacement', ['goal' => $goal])
                    </div>
                    <div>
                        @livewire('mant.goals.goal-supply', ['goal' => $goal])
                    </div>
                    <div>
                        @livewire('mant.goals.goal-service', ['goal' => $goal])
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        @livewire('mant.goals.goal-replacement-list', ['goal' => $goal])
                    </div>
                    <div>
                        @livewire('mant.goals.goal-supply-list', ['goal' => $goal])
                    </div>
                    <div>
                        @livewire('mant.goals.goal-service-list', ['goal' => $goal])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
