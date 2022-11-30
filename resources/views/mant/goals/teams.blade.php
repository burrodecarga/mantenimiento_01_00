<x-app-layout>
    <div class="card my-6 mx-auto max-w-md">
        <div class="card-body">
            <div class="w-full bg-gray-200 rounded p-4 mx-auto mb-4">
                <h1 class="text-center text-lg font-bold uppercase">Asignación de equipos de trabajo</h1>
                <p class="text-gray-600 italic text-sm">Ubicación:{{ $equipment->location() }}</p>
                <p class="text-gray-600 italic text-sm">Equipo:{{ $equipment->name }}</p>
                <p class="text-gray-600 italic text-sm">Tipo: {{ $equipment->prototype->name }}</p>
                <p class="text-gray-600 italic text-sm">Tareas: {{ $equipment->prototype->protocols->count() }}</p>
                <p class="text-gray-600 italic text-sm">Tiempo Estimado: {{ $equipment->prototype->protocols->sum('duration') }} hrs.</p>
                <p>Trabajadores para tareas:{{ $equipment->prototype->protocols->sum('workers') }}</p>
            </div>
            <form action="{{ route('goals.assign') }}">

                <input type="hidden" name="plan_id" value="{{ $plan->id }}"/>
                <input type="hidden" name="equipment_id" value="{{ $equipment->id }}"/>
                <div class="mb-4">
                <select multiple="multiple" name="teams[]" class="select w-full rounded">
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="mb-4">
                    <a type="button" href="{{ route('plans.teams',$plan->id) }}"
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

    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select').select2();
        });
    </script>
@endpush

</x-app-layout>
