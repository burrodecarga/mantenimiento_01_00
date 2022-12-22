<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-7xl mx-auto">
            <div class="card">
                <div class="card-body font-normal">
                    <h1 class="text-lg text-center text-gray-500 uppercase font-bold">{{ __('timelines')." : ".$plan->name }}</h1>
                    <h2 class="text-sm text-center text-gray-400 uppercase font-bold">{{ $plan->start->format('d-m-Y h:i A') }}</hh2>
                    <div  class="flex items-center justify-end mb-3 text-sm">
                        <a href="{{ URL::previous() }}"
                        class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                        <i class="fa-sharp fa-solid fa-list-check"></i>
                        {{ __('back') }}
                    </a>
                    </div>
                    <table id="timeline" class="text-sm">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="hidden">{{ __("position") }}</th>
                                <th class="hidden">{{ __("sequece") }}</th>
                                <th class="text-center">{{ __("date") }}</th>
                                <th>{{ __("start") }}</th>
                                <th>{{ __("end") }}</th>
                                <th>{{ __("task") }}</th>
                                <th>{{ __("team") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timelines as $timeline)
                                <tr class="odd:bg-slate-100">
                                    <td  class="text-center" width="5%">{{ $timeline->id }}</td>
                                    <td class="hidden" width="5%">{{ $timeline->position }}
                                    </td>
                                    <td class="hidden" width="5%">{{ $timeline->sequence }}
                                    </td>
                                    <td class="text-center" width="20%">
                                        <div class="text-center">
                                            <p class="text-gray-700 text-xs font-bold">
                                                {{ $timeline->fecha($timeline->start)}}
                                             </p>
                                             <p class="text-gray-700 text-xs">
                                                tiempo Estimado: {{ $timeline->duration }} hrs.
                                            </p>
                                        </div>
                                    </td>
                                    <td width="10%">
                                        <div>
                                            <p class="text-gray-700 text-xs">
                                                {{ $timeline->start->format('h:i A') }}
                                            </p>

                                        </div>
                                    </td>
                                    <td width="10%">
                                        <div>
                                            <p class="text-gray-700 text-xs">
                                                {{ $timeline->end->format('h:i A') }}
                                            </p>
                                        </div>
                                    </td>
                                    <td width="30%">
                                        <div>
                                            <p class="flex justify-between items-center text-gray-700 text-xs">
                                                <span>{{ $timeline->task }} </span>
                                            </p>
                                        </div>
                                    </td>
                                    <td width="20%">
                                        <div>
                                            @if($timeline->team_id)
                                            <p class="text-gray-700 font-bold text-xs">{{ $timeline->specialty() }}</p>
                                            @endif
                                            <p class="text-gray-700 font-bold text-xs">{{ $timeline->specialty() }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#timeline').DataTable({
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
                        "targets": [],
                        "orderable": false
                    }]
                });
            });

            $('.form-delete').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Está seguro de querer eliminar user?',
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
