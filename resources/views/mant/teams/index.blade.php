<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-3xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('team list') }}</h1>
            <div class="flex items-center justify-end mb-3">
                <a href="{{ route('teams.create') }}"
                    class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                    <i class="fa-solid fa-address-card"></i>
                    {{ __('add team') }}
                </a>
            </div>
            <table id="team" class="">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Cost</th>
                        <th>Members</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td width="40%">
                                <p class="text-gray-400 font-bold text-sm">{{ $team->name }}</p>
                                <p class="text-gray-400 font-bold text-xs">{{ $team->specialty() }}</p>

                                @foreach ($team->zones as $z )
                                <p class="text-red-400 font-bold text-xs">{{ $z->name }}</p>
                                @endforeach
                                <hr>
                            </td>
                            <td width="10%" class="text-right text-xs text-gray-400">{{ $team->cost() }}</td>
                            <td width="30%" class="text-right text-xs text-gray-400">
                                @foreach ($team->users as $user)
                                    <p>{{ $user->name }}</p>
                                @endforeach
                            </td>

                            <td class="text-center flex items-center justify-between">
                                <a href="{{ route('teams.members-add', $team->id) }}"
                                    title="{{ __('view daitl of team ') . $team->name }}"><i
                                        class="icono text-blue-600 fa-solid fa-people-group"></i></a>
                                <a href="{{ route('teams.edit', $team->id) }}"
                                    title="{{ __('edit team ') . $team->name }}"><i
                                        class="icono text-green-500 fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('teams.destroy', $team->id) }}" method="POST"
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
                $('#team').DataTable({
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
                    title: 'Está seguro de querer eliminar team?',
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
