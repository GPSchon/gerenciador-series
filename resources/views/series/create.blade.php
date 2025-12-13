<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cadastro de Séries
        </h2>
    </x-slot>
    <x-series.form :action="route('series.store')" :name="old('name')" :update="false" />
</x-app-layout>
