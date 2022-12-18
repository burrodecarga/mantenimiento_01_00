<div class="card">
    <div class="card-body">
        <h1 class="text-gray-500 text-center text-lg font-bold p-4 uppercase bg-slate-200">{{ __('assignment of features to prototype') }}: {{ '  '.$prototype->fullName() }}</h1>
    <div class="grid grid-cols-2 gap-3 border p-4">
        <div class=" border border-r-3 p-3">
            <h1 class="text-gray-600 text-center text-xl font-bold bg-slate-200">
                {{ __("available features") }}</h1>
            <input type="text" placeholder="{{ __("search feature") }}" class="w-full rounded my-2" wire:model="search">

            <ul>
               @foreach ($features as $key=>$f )
                <li class="px-4 py-1 mx-4 my-1 bg-gradient-to-r from-cyan-700 to-blue-500 rounded text-white">
                    <a class="cursor-pointer" wire:click="addFeature({{ $key }})">{{ $f }}</a>
                </li>
            @endforeach
            </ul>
        </div>

        <div class=" border border-r-3 p-3">
            <h1 class="text-gray-500 text-center text-xl font-bold mb-12 bg-slate-200">{{ __("features assigned") }}</h1>
            <ul>
               @foreach ($prototype->features as $f )
                <li class="p-3 mx-4 my-1 bg-gradient-to-r from-cyan-500 to-blue-500 rounded text-white">
                    <a class="cursor-pointer" wire:click="delFeature({{ $f->id }})">{{ $f->resume}}
                </li>
            @endforeach
            </ul>
        </div>
    </div>

    </div>
</div>
