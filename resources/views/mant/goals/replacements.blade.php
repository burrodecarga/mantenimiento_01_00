<x-app-layout>
    <div class="container my-6">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center text-gray-500 text-2xl my-3 font-bold">{{ $goal->equipment().'  '.$goal->task }}</h1>
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
