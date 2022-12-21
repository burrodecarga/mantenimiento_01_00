<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-7xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('plan list') }}</h1>
            <div class="flex items-center justify-end mb-3">
                <a href="{{ route('plans.create') }}"
                    class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                    <i class="fa-sharp fa-solid fa-list-check"></i>
                    {{ __('add plan') }}
                </a>
            </div>
            <table id="plan" class="">
                <thead>
                    <tr>
                        <th>Planes</th>
                        <th>Equipos</th>
                        <th>Recursos</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($plans as $plan)
                        <tr class="odd:bg-gray-100">
                            <td width="35%">
                                <div>
                                    <p class="text-gray-700 font-bold text-base">{{ $plan->name }}</p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('start date') }}:
                                        <strong>{{ $plan->start->format('d-m-Y') }}</strong>
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('start time') }}:
                                        <strong>{{ $plan->start_time->format('h:i A') }}</strong>
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('working shifts') }}:
                                        <strong>{{ $plan->work_shift }}</strong>
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('weekly working hours') }}:
                                        <strong>{{ $plan->weekly_shift }} horas</strong>
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('work time') }}:
                                        <strong>{{ $plan->work_time->format('h:i A') }}</strong>
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('daily working hours') }}:
                                        <strong>{{ $plan->daily_shift }} {{ __('hours') }}</strong>
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('rest hour') }}:
                                        <strong>{{ $plan->work_time->addhours($plan->rest_time_hours)->format('h:i A') }}-{{ $plan->work_time->addhours($plan->rest_hours + $plan->rest_time_hours)->format('h:i A') }}</strong>
                                        {{ __('hours total') }} :
                                        <strong>{{ $plan->rest_hours }} {{ __('hours') }}</strong>
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('work on holiday') }}:
                                        <strong>{{ $plan->work_holiday ? 'si' : 'no' }}</strong>
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ __('work overtime') }}:
                                        <strong>{{ $plan->work_overtime ? 'si' : 'no' }}</strong>
                                    </p>
                                </div>
                            </td>
                            <td width="15%">
                                <p class="text-gray-600 font-semibold text-sm">{{ __('equipments') }}:
                                    <strong>{{ $plan->equipments->count() }}</strong>
                                </p>
                                @foreach ($plan->equipments as $e)
                                    <p class="text-gray-600 font-semibold text-xs"">
                                        {{ $e->location() . '  : ' . $e->name }}</p>
                                @endforeach
                            </td>

                            <td width="30%">
                                <p class="text-gray-600 font-semibold text-sm">{{ __('tasks') }}:
                                    {{ $plan->goals->count() }}
                                </p>
                                <p class="text-gray-600 font-semibold text-sm">{{ __('estimated time') }}:
                                    {{ price($plan->goals->sum('duration')) }} {{ __('hrs.') }}.
                                </p>

                                <p class="text-gray-600 font-semibold text-sm">{{ __('replacements') }}:
                                    {{ price($plan->goals->sum('total_replacement')) }}
                                </p>
                                <p class="text-gray-600 font-semibold text-sm">{{ __('supplies') }}:
                                    {{ price($plan->goals->sum('total_supply')) }}
                                </p>
                                <p class="text-gray-600 font-semibold text-sm">{{ __('services') }}:
                                    {{ price($plan->goals->sum('total_service')) }}
                                </p>
                                <p class="text-gray-600 font-semibold text-sm">{{ __('workers') }}:
                                    {{ $tecnicos->count() }}
                                </p>

                                <p class="text-gray-600 font-semibold text-sm">
                                    {{ __('workers') }}-{{ __('hours') }}:
                                    {{ $tecnicos->count() * 8 }} {{ __('hrs.') }}
                                </p>
                                <p class="text-gray-600 font-semibold text-sm">
                                    {{ __('probable time') }}-{{ __('hours') }}:
                                    {{ ($plan->goals->sum('duration') / $tecnicos->count()) * 8 }} {{ __('hrs.') }}
                                </p>

                            </td>


                            <td class="flex flex-col gap-3">
                                <a class="col-span-3 w-full" href="{{ route('plans.show', $plan->id) }}"
                                    title="{{ __('add equipment to maintenance plan') . ' : ' . $plan->name }}">
                                    <i class="w-full text-xs icono text-green-500 hover:text-red-500 fab fa-phabricator">
                                        <span class="text-xs ml-3">{{ __('add equipments') }}</span> </i>
                                </a>
                                @if ($plan->equipments->count() > 0)
                                    <a class="col-span-3 w-full" href="{{ route('plans.protocols', $plan->id) }}"
                                        title="{{ __('add maintenance protocols to the plan') . ' : ' . $plan->name }}"><i
                                            class="icono w-full text-green-500 hover:text-red-500 fa fa-file-invoice">
                                            <span class="text-xs ml-3">{{ __('add protocols') }}</span></i>
                                    </a>
                                    <a class="col-span-3 w-full" href="{{ route('plans.resources', $plan->id) }}"
                                        title="{{ __('add resources to maintenance plan') . ' : ' . $plan->name }}">
                                        <i class="icono w-full text-green-500 hover:text-red-500 fa-solid fa-dumpster">
                                            <span class="text-xs ml-3">{{ __('add resources') }}</span>
                                        </i>
                                    </a>
                                    <a class="col-span-3 w-full" href="{{ route('plans.teams', $plan->id) }}"
                                        title="{{ __('add teams to maintenance plan') . ' : ' . $plan->name }}">
                                        <i class="icono w-full text-green-500 hover:text-red-500 fa-solid fa-users">
                                            <span class="text-xs ml-3">{{ __('add teams') }}</span>
                                        </i>
                                    </a>

                                    <a class="col-span-3 w-full" href="{{ route('plans.timeline', $plan->id) }}"
                                        title="{{ __('Generate a maintenance plan schedule according to the maintenance protocols for each piece of equipment') }}">
                                        <i class="w-full text-xs icono text-green-500 hover:text-red-500 fa-solid fa-clock-rotate-left">
                                            <span class="ml-3">{{ __('generate plan') }}</span> </i>
                                    </a>

                                    <a class="col-span-3 w-full" href="{{ route('plans.sequence', $plan->id) }}"
                                        title="{{ __('plan development sequence') . ' : ' . $plan->name }}"><i
                                            class="w-full icono text-green-500 hover:text-red-500 fa-solid fa-arrow-up-1-9">
                                            <span class="text-xs p-2">{{ __('add sequence') }}</span></i></a>
                                            <hr class="my-3">
                                    <a class="col-span-3 w-full" href="{{ route('plans.calendar', $plan->id) }}"
                                        title="{{ __('calendar generated to develop the plan') . ' : ' . $plan->name }}">
                                        <i class="w-full text-xs icono text-blue-600 hover:text-red-600 fa-solid fa-calendar">
                                            <span class="text-xs ml-3">{{ __('calendar') }}</span> </i>
                                    </a>
                                    <a class="col-span-3 w-full" href="{{ route('plans.timeline', $plan->id) }}"
                                        title="{{ __('calendar generated to develop the plan') . ' : ' . $plan->name }}">
                                        <i class="w-full text-xs icono text-blue-600 hover:text-red-600 fa-solid fa-calendar">
                                            <span class="text-xs ml-3">{{ __('timeline') }}</span> </i>
                                    </a>
                                    @endif
                                    <hr class="my-3">
                                    <a class="col-span-3 w-full" href="{{ route('plans.edit', $plan->id) }}"
                                        title="{{ __('calendar generated to develop the plan') . ' : ' . $plan->name }}">
                                        <i class="w-full text-xs icono text-blue-600 fa-solid fa-edit">
                                            <span class="text-xs ml-3">{{ __('edit plan') }}</span> </i>
                                    </a>

                                <form class="col-span-3 w-full" action="{{ route('plans.destroy', $plan->id) }}"
                                    method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="col-span-3 w-full">
                                        <i title="{{ __('delete plan') . ' : ' . $plan->name }}"
                                            class="icono w-full text-red-500 fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#plan').DataTable({
                    "pagingType": "full_numbers",
                    "language": {
                        "info": "Mostrando pag  _PAGE_ de _PAGES_  páginas,  Total de Registros: _TOTAL_ ",
                        "search": "Buscar  ",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                            "last": "Último",
                            "first": "Primero",
                        },
                        "lengthMenu": "Mostrar  <select class='custom-select custom-select-sm'>" +
                            "<option value='5'>5</option>" +
                            "<option value='10'>10</option>" +
                            "<option value='15'>15</option>" +
                            "<option value='20'>20</option>" +
                            "<option value='25'>25</option>" +
                            "<option value='50'>50</option>" +
                            "<option value='100'>100</option>" +
                            "<option value='-1'>Todos</option>" +
                            "</select> Registros",
                        "loadingRecord": "Cargando....",
                        "processing": "Procesando...",
                        "emptyTable": "No hay Registros",
                        "zeroRecords": "No hay coincidencias",
                        "infoEmpty": "",
                        "infoFiltered": ""
                    },
                    "columnDefs": [{
                        "targets": [2],
                        "orderable": false
                    }]
                });
            });

            $('.form-delete').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Está seguro de querer eliminar plan?',
                    text: "Esta operación es irreversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        this.submit();
                        // Swal.fire(
                        //   'Deleted!',
                        //   'Your file has been deleted.',
                        //   'success'
                        // )
                    }
                })


            })
        </script>
    @endpush
</x-app-layout>
