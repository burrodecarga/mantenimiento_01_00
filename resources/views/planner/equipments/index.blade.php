<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-7xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('equipment list') }}</h1>
            <div class="flex items-center justify-end mb-3">
                <a href="{{ route('equipments.create') }}"
                    class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                    <i class="fa-sharp fa-solid fa-list-check"></i>
                    {{ __('add equipment') }}
                </a>
            </div>
            <table id="equipment" class="">
                <thead>
                    <tr>
                        <th>Prototipo</th>
                        <th>Equipo</th>
                        <th>Condiciones</th>
                        <th>Caracteristicas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipments as $equipment)
                        <tr class="odd:bg-slate-100">
                            <td width="15%">
                                <div>
                                    <p class="text-gray-700 font-bold text-base">{{ $equipment->prototype->name }}</p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ $equipment->prototype->cha_1 }}
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ $equipment->prototype->cha_2 }}
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ $equipment->prototype->cha_3 }}
                                    </p>
                                    <p class="text-gray-600 font-semibold text-sm">{{ $equipment->prototype->cha_4 }}
                                    </p>
                                </div>
                            </td>
                            <td width="20%">
                                <p class="text-gray-600 font-semibold text-sm">Equipo: {{ $equipment->name }}</p>

                            </td>
                            <td width="30%">
                                <p class="text-gray-600 font-bold text-sm">Servicio : {{ $equipment->service }} horas al
                                    día</p>
                                <p class="text-gray-600 font-bold text-sm">Ubicacion : {{ $equipment->location }}</p>
                                <p class="text-gray-600 font-semibold text-xs">Descripción :
                                    {{ $equipment->description }}</p>
                            </td>
                            <td width="">
                                <div class="grid grid-cols-2 gap-3 text-xs">
                                    @foreach ($equipment->features as $f)
                                        <div class="flex items-center gap-1 border shadow rounded bg-gray-100 px-2">
                                            <div class="text-right">
                                                {{ $f->pivot->value }}
                                            </div>
                                            <div class="font-bold italic">
                                                {{ $f->symbol }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <td class="grid grid-cols-3 gap-4 items-center justify-between">
                                <a href="{{ route('equipments.show', $equipment->id) }}"
                                    title="{{ __('view detail of equipment')." : " . $equipment->task }}"><i
                                        class="icono text-blue-500 fa-solid fa-eye"></i></a>
                                <a href="{{ route('equipments.edit', $equipment->id) }}"
                                    title="{{ __('edit equipment')." : " . $equipment->task }}"><i
                                        class="icono text-green-500 fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST"
                                    class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i
                                        title="{{ __('delete equipment')." : " . $equipment->task }}"
                                            class="icono text-red-500 fa-solid fa-trash-can"></i></button>
                                </form>

                                <a href="{{ route('equipments.addFeatures', $equipment->id) }}"
                                    title="{{ __('add features to equipment') . $equipment->task }}"><i
                                        class="icono text-green-500 fa-solid fa-closed-captioning"></i>

                                    <a href="{{ route('equipments.addValues', $equipment->id) }}"
                                        title="{{ __('add values ​​to each equipment characteristic')." : " . $equipment->task }}">
                                        <i class="icono text-red-500 fa-solid fa-keyboard"></i>

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
                        "targets": [4],
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
