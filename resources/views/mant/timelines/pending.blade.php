<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-5xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('timeline list') }}</h1>

            <table id="timeline">
                <thead>
                    <tr>
                        <th>Equipment</th>
                        <th>Task</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Teams</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timelines as $timeline)
                        <tr>
                            <td width="20%">
                                <p class="text-gray-400 font-bold text-sm">{{ $timeline->equipment() }}</p>

                            </td>
                            <td width="20%">
                                <p class="text-red-400 font-bold text-xs">{{ $timeline->specialty() }}</p>
                                <p class="text-gray-400 font-bold text-sm">{{ $timeline->task }}</p>

                            </td>
                            <td width="12%" class="text-right text-xs text-gray-400">

                                <p class="text-red-400 font-bold text-xs">{{ $timeline->start->format('d-m-Y') }}</p>
                                <p class="text-red-400 font-bold text-xs">{{ $timeline->start->format('h:i A') }}</p>

                            </td>
                            <td width="12%" class="text-right text-xs text-gray-400">


                                <p class="text-red-400 font-bold text-xs">{{ $timeline->end->format('d-m-Y') }}</p>
                                <p class="text-red-400 font-bold text-xs">{{ $timeline->end->format('h:i A') }}</p>

                            </td>


                            <td width="10%" class="text-right text-xs text-gray-400">
                                <p class="text-gray-400 font-bold text-xs">
                                    @if ($timeline->status == 0)
                                        Activa
                                    @else
                                        Reparada
                                    @endif
                                </p>
                            </td>

                            <td width="19%" class="text-justify text-xs text-gray-400">

                            </td>

                            <td class="text-center flex items-center justify-between">
                                <a href=""
                                    title="{{ __('view daitl of timeline ') . $timeline->name }}"><i
                                        class="icono text-blue-600 fa-solid fa-people-group"></i></a>
                                <a href=""
                                    title="{{ __('edit timeline ') . $timeline->name }}"><i
                                        class="icono text-green-500 fa-solid fa-pen-to-square"></i></a>

                                <form action="" method="POST"
                                    class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i
                                            class="icono text-red-500 fa-solid fa-trash-can"></i></button>
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
                        "targets": [6],
                        "orderable": false
                    }]
                });
            });

            $('.form-delete').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Está seguro de querer eliminar timeline?',
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
