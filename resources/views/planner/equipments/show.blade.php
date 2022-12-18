<x-app-layout>
    <div class="container mx-auto p-6 my-8">
        <div class="grid grid-cols-2 gap-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-body"> @if($equipment->images->count())
                        <div class="flexslider max-h-80">

                            <ul class="slides aspect-4/3">
                                @foreach ($equipment->images as $image)
                                    <li>
                                        <img src="{{ asset($image->url) }}" style="max-height:320px;:" />

                                        <form action="{{ route('image-destroy', $image->id) }}" method="POST"
                                            class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="prototype_id" value="{{ $equipment->id }}"/>
                                            <button type="submit" class="cursor-pointer"><i class="text-red-500 fa-solid fa-trash-can cursor-pointer"></i></button>
                                        </form>
                                        <p class="text-blue-500">{{ $image->description }}</p>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                        @else
                        <div class="w-full m-auto text-gray-500 font-mono">
                         <img src="{{ asset('form\form2.jpg') }}" alt="">
                        </div>
                             @endif
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h1 class="font-bold text-gray-500 uppercase">{{ $equipment->name }}</h1>
                    <h2 class="text-sm text-gray-500 uppercase">{{ $equipment->cha_1 }}</h2>
                    <h2 class="text-sm text-gray-500 uppercase">{{ $equipment->cha_2 }}</h2>
                    <h2 class="text-sm text-gray-500 uppercase">{{ $equipment->cha_3 }}</h2>
                    <h2 class="text-sm text-gray-500 uppercase">{{ $equipment->cha_4 }}</h2>
                    <p class="mt-4 text-sm italic text-gray-500 italic">{{ $equipment->description }}</p>
                    <p class="text-sm text-gray-500 mt-3"> <i
                            class="mr-2 icono fa-solid fa-screwdriver-wrench text-green-600"></i><strong class="capitalize">{{ __('maintenance protocols') }}</strong>:
                        {{ $equipment->prototype->protocols->count()}} </p>
                    <p class="text-sm text-gray-500 mt-3"> <i
                            class="mr-2 icono text-blue-500 fa-solid fa-file-contract"></i><strong class="capitalize">{{ __("features") }}</strong>:
                        {{ $equipment->features->count() }} </p>

                    <p class="text-sm text-gray-500 mt-3">
                        <i class="icono mr-2 fa-solid fa-shuttle-space text-red-500"></i>
                        <strong class="capitalize">{{ __("prototype") }}</strong>:
                        {{ $equipment->prototype->name }}
                    </p>
                    <p class="text-sm text-gray-500 mt-3"> <i
                            class="mr-2 icono text-blue-500 fa-solid fa-file-contract"></i><strong class="capitalize">{{ __("zone")}}</strong>:
                            {{ $equipment->location() }}</p>
                            <p class="text-sm text-gray-500 mt-3"> <i
                                class="mr-2 icono text-red-700 fab fa-medapps"></i><strong class="capitalize">{{ __("fails") }}</strong>:
                            {{ $equipment->fails->count() }} </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-6 my-4">
            <div class="card col-span-2">
                <div class="card-title text-center font-bold text-lg my-4 capitalize">{{ __("protocols") }}</div>
                <div class="card-body">
                    @foreach ($equipment->prototype->protocols as $protocol)
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <p class="text-gray-600 font-semibold text-sm"><strong>{{ __("specialty") }}</strong>:
                                    {{ $protocol->specialty()->name }}</p>
                                <p class="text-gray-600 font-semibold text-sm"><strong>{{ __("task type") }}</strong> :

                            </div>
                            <div>
                                <p class="text-gray-600 font-bold text-sm">{{ __("position") }} : {{ $protocol->position }}</p>
                                <p class="text-gray-600 font-bold text-sm">{{ __("task") }} : {{ $protocol->task }}</p>
                                <p class="text-gray-600 font-bold text-xs">{{ __("detail") }} : {{ $protocol->detail }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-bold text-sm">{{ __("permissions") }} : {{ $protocol->permissions }}</p>
                                <p class="text-gray-600 font-bold text-xs">{{ __("security") }} : {{ $protocol->security }}</p>
                                </p>
                                <p class="text-gray-600 font-bold text-xs">{{ __("condition") }} : {{ $protocol->conditions }}</p>
                                <p class="text-gray-600 font-bold text-sm">{{ __("frecuency") }} : {{ $protocol->frecuency }} {{ __("times a year") }}</p>
                                <p class="text-gray-600 font-bold text-sm">{{ __("duration") }} : {{ $protocol->duration }} {{ __("hours") }}</p>
                                <p class="text-gray-600 font-bold text-sm">{{ __("workers") }} : {{ $protocol->workers }}
                                    {{ __("workers") }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                @endforeach
                </div>
            </div>
            <div class="card col-span-1 bg-red-500">
            <div class="card">
                <div class="card-title text-center font-bold text-lg my-4 capitalize">{{ __("features") }}</div>
                <div class="card-body">
                    @foreach ($equipment->features as $feature)
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
