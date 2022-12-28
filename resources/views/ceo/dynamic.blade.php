<x-app-layout>
    <div class="container my-4 mx-auto">
        <div class="card">
            <div class="card-body">


                <div class="grid grid-cols-5 gap-4 h-screen">
                    <div class="col-span-1 border text-center">
                        <label class="bg-slate-300 inline-block w-full text-center font-bold uppercase" for="start">{{ __("start") }}</label>
                        <input class="w-full mb-1" type="date" name="start" id="start">
                        <label class="bg-slate-300 inline-block w-full text-center font-bold uppercase" for="end">{{ __("end") }}</label>
                        <input class="w-full mb-1" type="date" name="end" id="end">
                        <h1 class="bg-slate-400 text-white px-3 py-2 text-center">{{ __('expenses') }}</h1>
                        <button onclick="personal()" class="w-full bg-green-600 px-3 py-2 text-white">{{ __("workers") }}</button>
                    </div>
                    <div class="col-span-4 border">
                        <div id="container"></div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="mb-3 bg-slate-300">
            <p>Edwin</p>
        </footer>
    </div>
    @push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

       <script src="{{ asset('js/chart/scripts.js') }}"></script>
    @endpush
</x-app-layout>
