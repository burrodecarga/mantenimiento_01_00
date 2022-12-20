<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-3xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('tasks list') }}</h1>

            <table id="fail">
                <thead>
                    <tr>
                        <th class="capitalize">{{ __("equipment") }}</th>
                        <th class="capitalize">{{ __("reported") }}</th>
                        <th class="capitalize">{{ __("assigned") }}</th>
                        <th class="capitalize">{{ __("repareid") }}</th>
                        <th class="capitalize text-center">{{ __("action") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fails as $fail)
                        <tr class="odd:bg-slate-100">
                            <td width="">
                                <p class="text-gray-400 font-bold text-sm">{{ $fail->equipment->name }}</p>
                                <p class="text-gray-400 font-bold text-sm">{{ $fail->equipment->location() }}</p>
                            </td>
                            <td width="" class="text-right text-xs text-gray-400">

                                <p class="text-red-400 font-bold text-xs">{{ $fail->reported_at->format('d-m-Y') }}</p>
                                <p class="text-red-400 font-bold text-xs">{{ $fail->reported_at->diffForHumans() }}</p>

                            </td>

                            <td width="" class="text-right text-xs text-gray-400">

                                <p class="text-red-400 font-bold text-xs">{{ $fail->repareid_at->format('d-m-Y') }}</p>
                                <p class="text-red-400 font-bold text-xs">{{ $fail->repareid_at->diffForHumans() }}</p>

                            </td>

                            <td width="" class="text-right text-xs text-gray-400">
                                @if($fail->teams->count() > 0)
                                <p class="text-red-400 font-bold text-xs">{{ $fail->assigned_at->format('d-m-Y') }}</p>
                                <p class="text-red-400 font-bold text-xs">{{ $fail->assigned_at->diffForHumans() }}</p>
                                @endif   </td>


                            <td class="text-center">
                                <a href="{{ route('fails.show', $fail->id) }}"
                                    title="{{ __('fail repair ') . $fail->name }}">
                                    <i class="icono text-green-600 fa-solid fa-person-digging"></i></a>
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
                $('#fail').DataTable({
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
                        "targets": [6],
                        "orderable": false
                    }]
                });
            });

            $('.form-delete').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Está seguro de querer eliminar fail?',
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
