<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-4xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('Teams Assign') }}</h1>
            <div class="flex items-center justify-end mb-3">
                <a href="{{ URL::previous() }}"
                class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                <i class="fa-sharp fa-solid fa-list-check"></i>
                {{ __('back') }}
            </a>
            </div>
            <table id="equipment" class="p-4">
                <thead>
                    <tr>
                        <th>equipment</th>
                        <th>Task</th>
                        <th>Teams</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipments as $equipment)
                        <tr class="even:bg-white odd:bg-blue-100">
                            <td width="">
                                <p>{{ $equipment->location() }}</p>
                                <p>{{ $equipment->name }}</p>
                                <p>Tipo: {{ $equipment->prototype->name }}</p>
                                <p>Tareas: {{ $equipment->prototype->protocols->count() }}</p>
                                <p>Tiempo Estimado: {{ $equipment->prototype->protocols->sum('duration') }} hrs.</p>
                                <p>Trabajadores para tareas:{{ $equipment->prototype->protocols->sum('workers') }}</p>
                            </td>
                            <td class="text-xs">
                                @foreach ($equipment->prototype->protocols as $t)
                                    <p>{{ $t->task }}</p>
                                @endforeach
                            </td>
                            <td class="text-xs">
                            @foreach ($equipment->teams($plan->id) as $t)
                                <p>{{ $t->name }}</p>
                            @endforeach

                            </td>

                            <td class="text-center">

                                <a href="{{ route('goals.teams', [$plan->id, $equipment->id]) }}" title="Add Team"><i
                                        class="icono text-green-500 fa-solid fa-users"></i></a>
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
                $('#equipment').DataTable({
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
                        "targets": [3],
                        "orderable": false
                    }]
                });
            });

            $('.form-delete').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Está seguro de querer eliminar equipment?',
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
