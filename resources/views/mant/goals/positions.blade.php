<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-7xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('goal list') }}</h1>
            <div class="flex items-center justify-end mb-3">

            </div>
            <table id="goal" class="">
                <thead>
                    <tr>
                        <th>equipment</th>
                        <th>Task</th>
                        <th>Position</th>
                        <th>Priority</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($goals as $goal)
                        <tr>
                            <td width="20%">
                                <p>{{ $goal->location() }}</p>
                                <p>{{ $goal->equipment() }}</p>
                                <p class="text-xs font-bold">{{ $goal->specialty() }}</p>
                            </td>
                            <td width="50%">
                                <p>{{ $goal->task }}</p>
                                <p>{{ $goal->detail }}</p>
                                @if($goal->restriction)
                                <p class="text-red-500 font-bold italic">Restricción: {{ $goal->restriction() }}</p>
                                @endif
                             </td>
                            <td width="10%">{{ $goal->position }}</td>
                            <td width="10%">{{ $goal->priority }}</td>
                            <td class="flex items-center justify-between">
                                <a href="{{ route('goals.edit',$goal->id) }}" title="{{ __('position of goal ').$goal->name }}"><i class="icono text-green-600 fa-solid fa-arrow-up-1-9"></i></a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>


    @push('scripts')
        <script>
           $(document).ready( function () {
        $('#goal').DataTable({
            "pagingType":"full_numbers",
           "language":{
             "info": "Mostrando pag  _PAGE_ de _PAGES_  páginas,  Total de Registros: _TOTAL_ ",
               "search":"Buscar  ",
               "paginate":{
                   "next":"Siguiente",
                   "previous":"Anterior",
                   "last":"Último",
                   "first":"Primero",
               },
               "lengthMenu":"Mostrar  <select class='custom-select custom-select-sm'>"+
                             "<option value='5'>5</option>"+
                             "<option value='10'>10</option>"+
                             "<option value='15'>15</option>"+
                             "<option value='20'>20</option>"+
                             "<option value='25'>25</option>"+
                             "<option value='50'>50</option>"+
                             "<option value='100'>100</option>"+
                             "<option value='-1'>Todos</option>"+
                             "</select> Registros",
               "loadingRecord":"Cargando....",
               "processing":"Procesando...",
               "emptyTable":"No hay Registros",
               "zeroRecords":"No hay coincidencias",
               "infoEmpty":"",
               "infoFiltered":""
           },
           "columnDefs": [{ "targets": [3], "orderable": false }]
        });
    } );

            $('.form-delete').submit(function(e){
                e.preventDefault();

                Swal.fire({
  title: 'Está seguro de querer eliminar goal?',
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
