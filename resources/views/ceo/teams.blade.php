<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 my-8 max-w-2xl mx-auto">
            <h1 class="text-base text-center text-gray-500 uppercase font-bold">{{ __('workers list') }}</h1>
            <h2 class="text-sm text-center text-gray-500 uppercase font-bold">{{ __('failures attended by worker') }}</h2>
            <div class="flex items-center justify-end mb-3">

            </div>
            <table id="user" class="">
                <thead>
                    <tr>
                        <th class="capitalize">{{ __("name") }}</th>
                        <th class="capitalize">{{ __("month") }}</th>
                        <th class=" capitalizetext-center">{{ __("fails") }}</th>
                        <th class=" capitalizetext-justify">{{ __("salary avg") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="odd:bg-slate-100">
                            <td width="50%">{{ $user->name }}</td>
                            <td width="10%">{{ MES[$user->mouth-1] }}</td>
                            <td class="text-center" width="10%">{{ $user->quantity }}</td>
                            <td class="text-center" width="30%">{{ price($user->salary) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>


    @push('scripts')
        <script>
           $(document).ready( function () {
        $('#user').DataTable({
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
                             "<option value='6'>6</option>"+
                             "<option value='12'>12</option>"+
                             "<option value='24'>24</option>"+
                             "<option value='36'>36</option>"+
                             "<option value='48'>48</option>"+
                             "<option value='96'>96</option>"+
                             "<option value='192'>192</option>"+
                             "<option value='-1'>Todos</option>"+
                             "</select> Registros",
               "loadingRecord":"Cargando....",
               "processing":"Procesando...",
               "emptyTable":"No hay Registros",
               "zeroRecords":"No hay coincidencias",
               "infoEmpty":"",
               "infoFiltered":"",
               "pageLength" : "12",
           },
           "columnDefs": [{ "targets": [], "orderable": false }]
        });
    } );

            $('.form-delete').submit(function(e){
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
