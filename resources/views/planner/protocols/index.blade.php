<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-7xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('protocol list') }}</h1>
            <div class="flex items-center justify-end mb-3">
                <a href="{{ route('protocols.create') }}"
                    class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                    <i class="fa-sharp fa-solid fa-list-check"></i>
                    {{ __('add protocol') }}
                </a>
            </div>
            <table id="protocol" class="">
                <thead>
                    <tr>
                        <th>Prototipo</th>
                        <th>Tipo de Tarea</th>
                        <th>Tarea</th>
                        <th>Detalles</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($protocols as $protocol)
                        <tr>
                            <td width="15%">
                                <div>
                                    <p class="text-gray-700 font-bold text-base">{{ $protocol->prototypes->count() }}</p>

                                </div>
                            </td>
                            <td width="20%">
                                <p class="text-gray-600 font-semibold text-sm">Especialidad : {{ $protocol->specialty()->name }}</p>
                                <p class="text-gray-600 font-semibold text-sm">Tipo de Tarea : {{ $protocol->typeTask()->name }}</p>
                            </td>
                            <td width="30%">
                                <p class="text-gray-600 font-bold text-sm">Posición : {{ $protocol->position }}</p>
                                <p class="text-gray-600 font-bold text-sm">Tarea : {{ $protocol->task }}</p>
                                <p class="text-gray-600 font-semibold text-xs">Detalle : {{ $protocol->detail }}</p>
                            </td>
                            <td width="">
                                <p class="text-gray-600 font-bold text-sm">Permisos : {{ $protocol->permissions }}</p>
                                <p class="text-gray-600 font-semibold text-xs">Seguridad : {{ $protocol->security }}</p>
                            </p>
                            <p class="text-gray-600 font-semibold text-xs">Condición : {{ $protocol->conditions }}</p>
                            <p class="text-gray-600 font-bold text-sm">Frecuencia : {{ $protocol->frecuency }} veces al año</p>
                            <p class="text-gray-600 font-bold text-sm">Duración : {{ $protocol->duration }} horas</p>
                            <p class="text-gray-600 font-bold text-sm">Trabajadores : {{ $protocol->workers }} trabajadores</p>
                            </td>

                            <td class="flex items-center justify-between">
                                {{-- <a href="{{ route('protocols.show',$protocol->id) }}" title="{{ __('view daitl of protocol ').$protocol->task }}"><i class="text-blue-500 fa-solid fa-eye"></i></a> --}}
                                <a href="{{ route('protocols.edit', $protocol->id) }}"
                                    title="{{ __('edit protocol ') . $protocol->task }}"><i
                                        class="text-green-500 fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('protocols.destroy', $protocol->id) }}" method="POST"
                                    class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="text-red-500 fa-solid fa-trash-can"></i></button>
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
                $('#protocol').DataTable({
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
                        "targets": [1],
                        "orderable": false
                    }]
                });
            });

            $('.form-delete').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Está seguro de querer eliminar protocol?',
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
