<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col space-y-2 p-4 text-center">
                    <h1 class="dark:text-gray-200 text-xl md:text-2xl">
                        Usa la barra de navegación para acceder las herramientas de este sistema.
                    </h1>
                    <p class="dark:text-gray-200 md:text-xl">Si tienes dudas contacta con tu superior.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>