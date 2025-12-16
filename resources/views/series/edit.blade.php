<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Serie {{ $series->name }}
        </h2>
    </x-slot>
    <x-series.form :action="route('series.update', $series->id)" name="{{ $series->name }}" :series="$series" />
</x-app-layout>
