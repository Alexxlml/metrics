<div class="py-8 px-4 space-y-4">
    <div class="grid grid-cols-4 gap-4 px-4 sm:px-0">
        <!-- Titulo -->
        <div class="col-span-4 md:col-span-2 xl:col-span-3">
            <h1 class="text-2xl dark:text-white text-center md:text-left">Subordinados</h1>
        </div>
        <!-- Botón agregar -->
        <div class="grid col-span-4 md:col-span-2 xl:col-span-1 justify-items-start md:justify-items-end">
            <a href="{{ route('agregar-jerarquia') }}"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Nuevo subordinado
            </a>
        </div>
    </div>
    <!-- Seleccion de roles y usuarios -->
    <x-section-title>
        <x-slot name="title">
            {{ __('Filtro de subordinados por jefe') }}
        </x-slot>
        <x-slot name="description">
            <span>{{ __('Selecciona un rol y el nombre de un jefe para filtrar los subordinados en la tabla.') }}</span><br>
            <span>{{ __('Por defecto la tabla muestra todos los subordinados registrados') }}</span>
        </x-slot>
    </x-section-title>
    <div class="grid grid-cols-4 gap-4 px-4 sm:px-0">
        <div class="col-span-4 md:col-span-2 xl:col-span-1">
            <x-label>{{ __('Roles') }}</x-label>
            <select wire:model.live="selectedRole"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Selecciona un Rol</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-4 md:col-span-2 xl:col-span-1">
            <x-label>{{ __('Jefes') }}</x-label>
            <select wire:model.live="selectedBoss" wire:key="{{ $selectedRole }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Selecciona un Jefe</option>
                @if($selectedRole)
                @foreach(App\Models\User::role($selectedRole)->get() as $boss)
                <option value="{{ $boss->id }}">{{ $boss->name }}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>

    <!-- Tabla de subordinados -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 sm:px-0">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Subordinado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Eliminar</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($subordinates as $subordinate)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $subordinate->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $subordinate->name }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button type="button" wire:click="deleteHierarchy({{ $subordinate->id }})"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $subordinates->links() }}
    </div>
</div>