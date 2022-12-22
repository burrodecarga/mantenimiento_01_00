<x-app-layout>
    <div class="card my-6 mx-auto max-w-md">
        <div class="card-body">
            <img src="{{ asset('form/form2.jpg') }}" alt="agregar sistema"
                class="max-h-16 w-full object-cover object-center">
            <h1
                class="text-gray-500 font-bold text-2xl px-3 py-2 w-full bg-slate-100 font-mono text-center uppercase">
                {{ __("teams assign") }}</h1>
            <div class="w-full bg-gray-200 rounded p-4 mx-auto mb-4">
                <p class="text-gray-600 italic text-sm capitalize">{{ __("location") }}:{{ $equipment->location() }}</p>
                <p class="text-gray-600 italic text-sm capitalize">{{ __("equipment") }}:{{ $equipment->name }}</p>
                <p class="text-gray-600 italic text-sm capitalize">{{ __("type") }}: {{ $equipment->prototype->name }}</p>
                <p class="text-gray-600 italic text-sm capitalize">{{ __("tasks") }}: {{ $equipment->prototype->protocols->count() }}</p>
                <p class="text-gray-600 italic text-sm capitalize">{{ __("estimated time") }}: {{ $equipment->prototype->protocols->sum('duration') }} hrs.</p>
                <p class="text-gray-600 italic text-sm capitalize">{{ __("workers") }}:{{ $equipment->prototype->protocols->sum('workers') }}</p>
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
                                {{ __('update') }}
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
