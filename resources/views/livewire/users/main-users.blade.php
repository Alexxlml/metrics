<div class="py-8 px-4 space-y-4">
    <div class="grid grid-cols-4 gap-4 px-4 sm:px-0">
        <!-- Botón agregar -->
        <div class="grid col-start-4 col-span-1 justify-end">
            <div class="flex justify-center">
            <a role="button" tabindex="0" wire:click="$set('showUploadModal', true)"
                class="inline-flex focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mr-1">
                    <path d="M7.25 10.25a.75.75 0 0 0 1.5 0V4.56l2.22 2.22a.75.75 0 1 0 1.06-1.06l-3.5-3.5a.75.75 0 0 0-1.06 0l-3.5 3.5a.75.75 0 0 0 1.06 1.06l2.22-2.22v5.69Z" />
                    <path d="M3.5 9.75a.75.75 0 0 0-1.5 0v1.5A2.75 2.75 0 0 0 4.75 14h6.5A2.75 2.75 0 0 0 14 11.25v-1.5a.75.75 0 0 0-1.5 0v1.5c0 .69-.56 1.25-1.25 1.25h-6.5c-.69 0-1.25-.56-1.25-1.25v-1.5Z" />
                  </svg>                  
                Cargar
            </a>
            <a href="{{ route('agregar-usuario') }}"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Crear
            </a>
        </div>
        </div>
    </div>

    <!-- Tabla de subordinados -->

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 sm:space-y-0 pb-4 bg-white dark:bg-gray-800">
            <div x-data="{ open: false }">
                <button @click="open = ! open"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    <span class="sr-only">Por página</span>
                    Por página
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div x-show="open"
                    class="absolute z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                        <li>
                            <a wire:click="$set('perPage', 5)" @click="open = ! open"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">5</a>
                        </li>
                        <li>
                            <a wire:click="$set('perPage', 10)" @click="open = ! open"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">10</a>
                        </li>
                        <li>
                            <a wire:click="$set('perPage', 20)" @click="open = ! open"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">20</a>
                        </li>
                    </ul>
                </div>
            </div>
            <label for="table-search" class="sr-only">Búsqueda</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search-users" wire:model.live="search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Búsqueda de usuarios">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex space-x-2">
                            <button type="button" wire:click="changeSortBy('id')"
                                class="hover:text-gray-400 hover:dark:text-gray-200 hover:scale-125 hover:transition-all">
                                ID
                            </button>
                            <button type="button" wire:click="changeSortAsc('id')"
                                class="hover:text-gray-400 hover:dark:text-gray-200 hover:scale-150 hover:transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="w-4 h-4">
                                    <path fill-rule="evenodd"
                                        d="M13.78 10.47a.75.75 0 0 1 0 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 1 1 1.06-1.06l.97.97V5.75a.75.75 0 0 1 1.5 0v5.69l.97-.97a.75.75 0 0 1 1.06 0ZM2.22 5.53a.75.75 0 0 1 0-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1-1.06 1.06l-.97-.97v5.69a.75.75 0 0 1-1.5 0V4.56l-.97.97a.75.75 0 0 1-1.06 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex space-x-2">
                            <button type="button" wire:click="changeSortBy('name')"
                                class="hover:text-gray-400 hover:dark:text-gray-200 hover:scale-125 hover:transition-all">
                                NOMBRE
                            </button>
                            <button type="button" wire:click="changeSortAsc('name')"
                                class="hover:text-gray-400 hover:dark:text-gray-200 hover:scale-150 hover:transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="w-4 h-4">
                                    <path fill-rule="evenodd"
                                        d="M13.78 10.47a.75.75 0 0 1 0 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 1 1 1.06-1.06l.97.97V5.75a.75.75 0 0 1 1.5 0v5.69l.97-.97a.75.75 0 0 1 1.06 0ZM2.22 5.53a.75.75 0 0 1 0-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1-1.06 1.06l-.97-.97v5.69a.75.75 0 0 1-1.5 0V4.56l-.97.97a.75.75 0 0 1-1.06 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Teléfono
                    </th>
                    <th scope="col" colspan="2" class="px-6 py-3 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ $user->id }}
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div>
                            <div class="text-base font-semibold">{{ $user->name }}</div>
                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->phone }}
                    </td>
                    <td class="py-4">
                        <a role="button" tabindex="0" wire:click="openModalToChange({{ $user->id }})"
                            class="flex justify-center text-yellow-600 hover:text-yellow-700 dark:text-yellow-500 hover:dark:text-yellow-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    </td>
                    <td class="py-4">
                        <a role="button" tabindex="0" wire:click="deleteUser({{ $user->id }})"
                            class="flex justify-center text-red-600 hover:text-red-700 dark:text-red-500 hover:dark:text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

    <!-- Upload file modal -->
    <x-dialog-modal wire:model="showUploadModal">
        <x-slot name="title">
            {{ __('Subida de archivo .json') }}
        </x-slot>
        <x-slot name="content">

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Cargar
                archivo</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="file_input" type="file" wire:model="fillFile" wire:loading.attr="disabled"
                wire:loading.class="opacity-50" accept=".json">
            <x-input-error for="fillFile" class="mt-2" />
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showUploadModal', false)" wire:loading.attr="disabled"
                wire:loading.class="opacity-50" class="mr-2">Cancelar</x-secondary-button>
            <x-button wire:click="createMultipleUsers" wire:loading.attr="disabled"
                wire:loading.class="opacity-50">Guardar</x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Change password modal -->
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Cambiar contraseña') }} <br>
            <span class="text-sm">Asegurate de escribir correctamente la contraseña.</span>
        </x-slot>
        <x-slot name="content">
            <x-label for="password">{{ __('Nueva contraseña') }}</x-label>
            <x-input id="password" class="block mt-1 w-full" type="password" wire:model.blur="password"
                wire:loading.attr="disabled" wire:loading.class="opacity-50" />
            <x-input-error for="password" class="mt-2" />
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled"
                wire:loading.class="opacity-50" class="mr-2">Cancelar</x-secondary-button>
            <x-button wire:click="changePassword" wire:loading.attr="disabled"
                wire:loading.class="opacity-50">Guardar</x-button>
        </x-slot>
    </x-dialog-modal>
</div>