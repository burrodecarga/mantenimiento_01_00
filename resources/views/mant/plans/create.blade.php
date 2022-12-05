<x-app-layout>
    <div class="container my-4">
        <form action="{{ route('plans.store') }}" method="POST" class="max-w-5xl mx-auto rounded-lg shadow-lg">
            @csrf
            @method('post')
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ __($title) }}</h1>
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-3">
                        <div class="mb-4 w-full col-span-6 md:col-span-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('Nombre del Plan') }}"
                                for="name" />
                            <x-jet-input type="text" name="name" class="w-full "
                                placeholder="{{ __('input plan name') }}" value="{{ old('name', $plan->name) }}" />
                            <x-jet-input-error for="name" />
                        </div>
                        <div class="mb-4 w-full col-span-6 md:col-span-1">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('Fecha inicio') }}" for="start" />
                            <input type="date" name="start" class="w-full rounded-lg" placeholder="{{ __('input start') }}"
                                value="{{ old('start', $plan->start) }}" />
                            <x-jet-input-error for="start" />
                        </div>
                        <div class="mb-4 w-full col-span-6 md:col-span-1">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('Hora de inicio') }}"
                                for="start_time" />
                            <input type="time" name="start_time" class="w-full rounded-lg "
                                placeholder="{{ __('input start_time') }}"
                                value="{{ old('start_time', $plan->start_time ) }}" />
                            <x-jet-input-error for="start_time" />
                        </div>
                        <div class="col-span-6 md:col-span-2">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('Turnos Laborables') }}"
                                for="service" />
                            <select name="work_shift" class="w-full rounded-lg">
                                @for ($i = 1; $i <= 3; $i++)
                                    <option value="{{ $i }}" @if($i==$plan->work_shift) selected @endif>{{ $i . ' turnos por día' }}</option>
                                @endfor
                            </select>
                            <x-jet-input-error for="work_shift" />
                        </div>
                        <div class="col-span-6 md:col-span-2">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('Horas laborables por semana') }}"
                                for="weekly_shift" />
                            <select name="weekly_shift" class="w-full rounded-lg">
                                @for ($i = 1; $i <= 56; $i++)
                                    <option value="{{ $i }}" @if($i==$plan->weekly_shift) selected @endif>{{ $i . ' horas por semana' }}</option>
                                @endfor
                            </select>
                            <x-jet-input-error for="weekly_shift" />
                        </div>
                        <div class="col-span-6 md:col-span-2">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('jornada diaria en horas') }}"
                                for="daily_shift" />
                            <select name="daily_shift" class="w-full rounded-lg">
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" @if($i==$plan->daily_shift) selected @endif>{{ $i . ' horas por día' }}</option>
                                @endfor
                            </select>
                            <x-jet-input-error for="daily_shift" />
                        </div>
                        <div class="mb-4 w-full col-span-6 md:col-span-2 rounded-lg">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('hora de descanso') }}"
                                for="rest_time" />
                            <input type="time" name="rest_time" class="w-full rounded-lg"
                                placeholder="{{ __('input rest_time') }}"
                                value="{{ old('rest_time', $plan->rest_time) }}" />
                            <x-jet-input-error for="rest_time" />
                        </div>
                        <div class="mb-4 w-full col-span-6 md:col-span-2">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('horas de descanso') }}"
                                for="rest_hours" />
                            <select name="rest_hours" class="w-full rounded-lg">
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" @if($i==$plan->rest_hours) selected @endif>{{ $i . ' horas por día' }}</option>
                                @endfor
                            </select>
                            <x-jet-input-error for="rest_hours" />
                        </div>
                        <div class="flex justify-between items-center gap-2 col-span-2 text-center">
                            <div class="w-full">
                                <x-jet-label class="italic my-2 capitalize" value="{{ __('trabajo en feriados') }}"
                                    for="work_holiday" />
                                <input type="checkbox" name="work_holiday"  @if(old('work_holiday') == 'on') checked="checked" @endif>
                                <x-jet-input-error for="work_holiday" />
                            </div>
                            <div class="w-full">
                                <x-jet-label class="italic my-2 capitalize" value="{{ __('trabajo sobretiempo') }}"
                                    for="work_overtime" />
                                <input type="checkbox" name="work_overtime"  @if(old('work_overtime') == 'on') checked="checked" @endif>
                                <x-jet-input-error for="work_overtime" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <x-jet-label class="italic capitalize" value="{{ __('descripción del plan') }}"
                                for="description" />
                            <textarea name="description" class="w-full rounded">{{ old('description', $plan->description) }}</textarea>
                            <x-jet-input-error for="description" />
                        </div>
                            <a type="button" href="{{ route('plans.index') }}"
                                class="bg-yellow-500 text-white hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('cancel') }}
                            </a>

                            <button type="submit"
                                class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('submit') }}
                            </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
