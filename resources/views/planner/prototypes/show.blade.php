<x-app-layout>
    <div class="container mx-auto p-6 my-8">
        <div class="grid grid-cols-2 gap-6">
            <div class="card">
                <div class="card-body">
                    <div class="flexslider max-h-80">
                        <ul class="slides aspect-4/3">
                            @foreach ($prototype->images as $image)
                                <li>
                                    <img src="{{ asset($image->url) }}" style="max-height:320px;:" />

                                    <form action="{{ route('image-destroy', $image->id) }}" method="POST"
                                        class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="prototype_id" value="{{ $prototype->id }}"/>
                                        <button type="submit" class="cursor-pointer"><i class="text-red-500 fa-solid fa-trash-can cursor-pointer"></i></button>
                                    </form>
                                    <p class="text-blue-500">{{ $image->description }}</p>
                                </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h1 class="font-bold text-gray-500 uppercase">{{ $prototype->name }}</h1>
                    <h2 class="text-sm text-gray-500 uppercase">{{ $prototype->cha_1 }}</h2>
                    <h2 class="text-sm text-gray-500 uppercase">{{ $prototype->cha_2 }}</h2>
                    <h2 class="text-sm text-gray-500 uppercase">{{ $prototype->cha_3 }}</h2>
                    <h2 class="text-sm text-gray-500 uppercase">{{ $prototype->cha_4 }}</h2>
                    <p class="mt-4 text-sm italic text-gray-500 italic">{{ $prototype->description }}</p>
                    <p class="text-sm text-gray-500 mt-3"> <i
                            class="mr-2 icono fa-solid fa-screwdriver-wrench text-green-600"></i><strong>Protocols</strong>:
                        {{ $prototype->protocols->count() }} </p>
                    <p class="text-sm text-gray-500 mt-3"> <i
                            class="mr-2 icono text-blue-500 fa-solid fa-file-contract"></i><strong>Features</strong>:
                        {{ $prototype->features->count() }} </p>

                    <p class="text-sm text-gray-500 mt-3">
                        <i class="icono mr-2 fa-solid fa-shuttle-space text-red-500"></i>
                        <strong>Equipments </strong>:
                        {{ $prototype->equipments->count() }}
                    </p>
                    <p class="text-sm text-gray-500 mt-3"> <i
                            class="mr-2 icono text-blue-500 fa-solid fa-file-contract"></i><strong>Zones: </strong>: </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-6 my-4">
            <div class="card col-span-2">
                <div class="card-title text-center font-bold text-lg my-4">Protocols</div>
                <div class="card-body">
                    @foreach ($prototype->protocols as $protocol)
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <p class="text-gray-600 font-semibold text-sm"><strong>Especialidad</strong>:
                                    {{ $protocol->specialty()->name }}</p>
                                <p class="text-gray-600 font-semibold text-sm"><strong>Tipo de Tarea</strong> :
                                    {{ $protocol->typeTask()->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-bold text-sm">Posición : {{ $protocol->position }}</p>
                                <p class="text-gray-600 font-bold text-sm">Tarea : {{ $protocol->task }}</p>
                                <p class="text-gray-600 font-semibold text-xs">Detalle : {{ $protocol->detail }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-bold text-sm">Permisos : {{ $protocol->permissions }}</p>
                                <p class="text-gray-600 font-semibold text-xs">Seguridad : {{ $protocol->security }}</p>
                                </p>
                                <p class="text-gray-600 font-semibold text-xs">Condición : {{ $protocol->conditions }}</p>
                                <p class="text-gray-600 font-bold text-sm">Frecuencia : {{ $protocol->frecuency }} veces al
                                    año</p>
                                <p class="text-gray-600 font-bold text-sm">Duración : {{ $protocol->duration }} horas</p>
                                <p class="text-gray-600 font-bold text-sm">Trabajadores : {{ $protocol->workers }}
                                    trabajadores</p>
                            </div>
                        </div>
                        <hr class="my-2">
                @endforeach
                </div>
            </div>
            <div class="card col-span-1 bg-red-500">
            <div class="card">
                <div class="card-title text-center font-bold text-lg my-4">Features</div>
                <div class="card-body">
                    @foreach ($prototype->features as $feature)
                    <div>
                        <p class="text-gray-600 font-semibold text-sm">
                            <strong>{{ $feature->measure }}</strong>
                             : <span class="text-xs">  {{ $feature->unit }}</span></p>

                    </div>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
     </div>
    </div>

    @push('scripts')
        <script>
            $(window).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",

                });
            });
        </script>
    @endpush
</x-app-layout>
