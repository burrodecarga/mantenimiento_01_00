<div class="card">
    <div class="card-body text-xs">
        <h1 class="text-gray-500 text-center text-2xl text-bold">Plan de Mantenimiento: {{ '  '.$plan->name }}</h1>
    <div class="grid grid-cols-2 gap-3 border p-4">
        <div class=" border border-r-3 p-3">
            <h1 class="text-gray-600 text-center text-xl font-bold">Equipos disponibles</h1>
            <input type="text" placeholder="buscar caracteristicas" class="w-full rounded my-2" wire:model="search">
            <ul>
               @foreach ($equipments as $f )
                <li class="px-4 py-1 mx-4 my-1 bg-gradient-to-r from-cyan-900 to-blue-500 rounded text-white">
                    <a class="cursor-pointer" wire:click="addEquipment({{ $f->id }})">{{$f->location().' '. $f->name }}</a>
                </li>
            @endforeach
            </ul>
        </div>

        <div class=" border border-r-3 p-3">
            <h1  class="text-gray-500 text-center text-xl font-bold mb-12">Equipos Asignados</h1>
            <ul>
               @foreach ($plan->equipments as $f )
                <li class="px-4 py-1 mx-4 my-1 bg-gradient-to-r from-blue-700 to-blue-500 rounded text-white">
                    <a class="cursor-pointer" wire:click="delEquipment({{ $f->id }})">{{ $f->location().' - '.$f->name}}
                </li>
            @endforeach
            </ul>
        </div>
    </div>

    </div>
</div>
