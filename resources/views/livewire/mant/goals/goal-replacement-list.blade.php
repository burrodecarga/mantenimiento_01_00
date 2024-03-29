<article class="shadow-lg border border-gray-100 rounded p-2">
    <div class="">
        <div class="">
            <h1 class="text-xl font-bold text-gray-500">{{ __("replacements list") }}</h1>
            <hr class="mt-2 mb-3">
           <div class='m-2 space-y-6'>
            @foreach($replacements as $replacement)
                <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-3 py-0" role="alert">
                    <p class="font-bold text-xs">{{ $replacement->name }}</p>
                    <p class="text-xs flex justify-between items-center">{{ __("quantity") }}:{{ $replacement->pivot->quantity }} .
                        <i title="{{ __("remove item") }}" class="icono text-red-500 cursor-pointer fa-solid fa-trash-can" wire:click="remove({{ $replacement->pivot->id }})"></i>
                    </p>
                    <p class="text-xs">{{ __("total") }}: {{ $replacement->pivot->total }}.</p>
                </div>
            @endforeach
           </div>
        </div>
    </div>
</article>
