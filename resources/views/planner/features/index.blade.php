<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-2xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('feature list') }}</h1>
            <div class="flex items-center justify-end mb-3">
                <a href="{{ route('features.create') }}" class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                    <i class="fa-solid fa-address-card"></i>
                    {{ __('add feature') }}
                </a>
            </div>
            <table id="feature" class="">
                <thead>
                    <tr>
                        <th>Medida</th>
                        <th>Unidad</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-500">
                    @foreach ($features as $feature)
                        <tr>
                            <td>{{ $feature->measure }}</td>
                            <td>
                               <p>{{ $feature->unit }}</p>
                               <p>{{ $feature->symbol }}</p>
                            </td>
                            <td class="flex items-center justify-between">
                                {{-- <a href="{{ route('features.show',$feature->id) }}" title="{{ __('view daitl of feature ').$feature->name }}"><i class="text-blue-500 fa-solid fa-eye"></i></a> --}}
                                <a href="{{ route('features.edit',$feature->id) }}" title="{{ __('edit feature ').$feature->unit }}"><i class="text-green-500 fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('features.destroy',$feature->id) }}" method="POST" class="form-delete">
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
           $(document).ready( function () {
        $('#feature').DataTable({
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
           "columnDefs": [{ "targets": [2], "orderable": false }]
        });
    } );

            $('.form-delete').submit(function(e){
                e.preventDefault();

                Swal.fire({
  title: 'Está seguro de querer eliminar feature?',
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
