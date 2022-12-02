<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-7xl mx-auto">
            <div class="card">
                <div class="card-body">
                    <table id="timeline" class="">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Position</th>
                                <th>Date</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Tarea</th>
                                <th>Equipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timelines as $timeline)
                                <tr>
                                    <td width="5%">{{ $timeline->id }}</td>
                                    <td width="5%">{{ $timeline->position }}
                                    </td>
                                    <td width="20%">
                                        <div class="text-center">
                                            <p class="text-gray-700 text-xs">
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
                                                {{ $timeline->start->format('H:i') }}
                                            </p>

                                        </div>
                                    </td>
                                    <td width="10%">
                                        <div>
                                            <p class="text-gray-700 text-xs">
                                                {{ $timeline->end->format('H:i') }}
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
                                            <p class="text-gray-700 text-xs">{{ $timeline->equipment() }}</p>
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
