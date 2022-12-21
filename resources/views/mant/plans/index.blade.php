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
                        <th>{{ __("plans") }}</th>
                        <th>{{ __("start") }}</th>
                        <th>{{ __("task") }}</th>
                        <th>{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($plans as $plan)
                        <tr class="odd:bg-gray-100">
                            <td width=""><p class="text-gray-700 font-bold text-base">{{ $plan->name }}</p></td>
                            <td width="">
                                <p class="text-gray-600 font-semibold text-sm">{{ __('start date') }}:
                                    <strong>{{ $plan->start->format('d-m-Y') }}</strong>
                                </p>
                                <p class="text-gray-600 font-semibold text-sm">{{ __('start time') }}:
                                    <strong>{{ $plan->start_time->format('h:i A') }}</strong>
                                </p></td>
                            <td width="">
                                <p class="text-gray-600 font-semibold text-sm">{{ __('equipments') }}:
                                    <strong>{{ $plan->equipments->count() }}</strong>
                                </p>
                                <p class="text-gray-600 font-semibold text-sm">{{ __('tasks') }}:
                                {{ $plan->goals->count() }}
                            </p></td>
                            <td width=""><a class="col-span-3 w-full" href="{{ route('plans.show', $plan->id) }}"
                                title="{{ __('details') . ' : ' . $plan->name }}">
                                <i class="w-full text-xs icono text-green-500 hover:text-red-500 fab fa-phabricator">
                                    <span class="text-xs ml-3">{{ __('details') }}</span> </i>
                            </a></td>
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
