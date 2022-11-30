<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-6xl mx-auto">
            <h1 class="text-2xl text-center text-gray-500 uppercase font-bold">{{ __('replacement list') }}</h1>
            <div class="flex items-center justify-end mb-3">
                <a href="{{ route('replacements.create') }}" class="px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-400">
                    <i class="fa-solid fa-address-card"></i>
                    {{ __('add replacement') }}
                </a>
            </div>
            <table id="replacement" class="">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Supply</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($replacements as $replacement)
                        <tr>
                            <td>{{ $replacement->name }}</td>
                            <td>{{ $replacement->brand }}</td>
                            <td>{{ $replacement->supply }}</td>
                            <td>{{ $replacement->price }}</td>
                            <td>{{ $replacement->stock }}</td>
                            <td>{{ $replacement->description }}</td>
                            <td class="flex items-center justify-between gap-3">
                                {{-- <a href="{{ route('systems.show',$replacement->id) }}" title="{{ __('view daitl of replacement ').$replacement->name }}"><i class="text-blue-500 fa-solid fa-eye"></i></a> --}}
                                <a href="{{ route('replacements.edit',$replacement->id) }}" title="{{ __('edit replacement ').$replacement->name }}"><i class="icono text-green-500 fa-solid fa-pen-to-square"></i></a>

                                <form action="{{ route('replacements.destroy',$replacement->id) }}" method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="icono text-red-500 fa-solid fa-trash-can"></i></button>
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
        $('#replacement').DataTable({
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
           "columnDefs": [{ "targets": [7], "orderable": false }]
        });
    } );

            $('.form-delete').submit(function(e){
                e.preventDefault();

                Swal.fire({
  title: 'Está seguro de querer eliminar replacement?',
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
