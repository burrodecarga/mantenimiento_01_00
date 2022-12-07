<article class="shadow-lg border border-gray-100 rounded p-2">
    <div class="">
        <div class="">
            <h1 class="text-xl font-bold text-gray-500">Observaciones</h1>
            <hr class="mt-2 mb-3">
           <div class='m-2 space-y-6'>
            @foreach($comments as $comment)
                <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-3 py-2" role="alert">
                      <p class="text-xs flex justify-between items-center">{{ $comment->comment }}
                        <i class="icono mx-3 text-red-500 cursor-pointer fa-solid fa-trash-can" wire:click="remove({{ $comment->id }})"></i>
                    </p>
               </div>
            @endforeach
           </div>
        </div>
    </div>
</article>
