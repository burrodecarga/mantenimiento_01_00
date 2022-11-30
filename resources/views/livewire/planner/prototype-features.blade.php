<div class="card">
    <div class="card-body">
        <h1 class="text-gray-500 text-center text-2xl font-bold p-4">Asignación de Caracteristicas a Prototipo{{ '  '.$prototype->fullName() }}</h1>
    <div class="grid grid-cols-2 gap-3 border p-4">
        <div class=" border border-r-3 p-3">
            <h1 class="text-gray-600 text-center text-xl font-bold">Caracteristicas disponibles</h1>
            <input type="text" placeholder="buscar caracteristicas" class="w-full rounded my-2" wire:model="search">

            <ul>
               @foreach ($features as $key=>$f )
                <li class="px-4 py-1 mx-4 my-1 bg-gradient-to-r from-cyan-700 to-blue-500 rounded text-white">
                    <a class="cursor-pointer" wire:click="addFeature({{ $key }})">{{ $f }}</a>
                </li>
            @endforeach
            </ul>
        </div>

        <div class=" border border-r-3 p-3">
            <h1 class="text-gray-500 text-center text-xl font-bold mb-12">Caracteristicas Asignada</h1>
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
