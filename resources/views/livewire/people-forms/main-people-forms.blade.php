<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Registros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg md:p-4">
                <div class="grid grid-cols-4 gap-4 px-4 sm:px-0">
                    <!-- Titulo -->
                    <div class="col-span-4 md:col-span-2 xl:col-span-3">
                        <p class="text-md md:text-base dark:text-white text-center md:text-left">{{ $ownerUserName }}
                            <span
                                class="bg-blue-100 text-blue-800 text-xs md:text-base font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                {{ $count_forms }}
                            </span>
                        </p>
                    </div>
                    <!-- Botón agregar -->
                    @can('forms create')
                    <div
                        class="grid col-span-4 md:col-span-2 xl:col-span-1 row-span-1 justify-items-start md:justify-items-end">
                        <a href="{{ route('agregar-registro') }}"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Agregar
                        </a>
                    </div>
                    @endcan
                </div>

                <!-- Tabla de subordinados -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 sm:px-0">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 sm:space-y-0 pb-4 bg-white dark:bg-gray-800">
                        <div x-data="{ open: false }">
                            <button @click="open = ! open"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                type="button">
                                <span class="sr-only">Por página</span>
                                Por página
                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div x-show="open"
                                class="absolute z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownActionButton">
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
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-users" wire:model.live="search"
                                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Búsqueda de registros">
                        </div>
                    </div>
                    <table class="@if(!$forms)min-h-[40vh]@endif w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                                    Nombre
                                </th>
                                @if($showCheckVote && $authorizeChangeVote)
                                <th scope="col" class="px-6 py-3">
                                    Voto
                                </th>
                                @endif
                                <th scope="col" class="px-6 py-3 text-center">
                                    Teléfono
                                </th>
                                <th scope="col" colspan="2" class="px-6 py-3 text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($forms as $form)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-xs md:text-sm">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $form->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $form->first_name }} {{ $form->first_surname }}
                                </td>
                                @if($showCheckVote && $authorizeChangeVote)
                                <td class="px-6 py-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer"
                                            wire:click="changeVoteState({{ $form->id }}, {{ $form->vote }})"
                                            @if($form->vote) checked @endif>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </td>
                                @endif
                                <td class="px-6 py-4">
                                    <a href="tel:{{ $form->phone }}"
                                        class="flex justify-center text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M15 3.75a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0V5.56l-4.72 4.72a.75.75 0 1 1-1.06-1.06l4.72-4.72h-2.69a.75.75 0 0 1-.75-.75Z"
                                                clip-rule="evenodd" />
                                            <path fill-rule="evenodd"
                                                d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                                @unlessrole('Data Capturer')
                                <td class="py-4">
                                    <a href="{{ route('editar-registro', ['id' => $form->id]) }}"
                                        class="flex justify-center text-yellow-600 hover:text-yellow-700 dark:text-yellow-500 hover:dark:text-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                </td>
                                @endunlessrole
                                @hasrole('Data Capturer')
                                <td class="py-4">
                                    <a role="button" tabindex="0" wire:click="openModalToChange({{ $form->id }})"
                                        class="flex justify-center text-yellow-600 hover:text-yellow-700 dark:text-yellow-500 hover:dark:text-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="py-4">
                                    <a href="{{ route('editar-registro', ['id' => $form->id]) }}"
                                        class="flex justify-center text-blue-600 hover:text-blue-700 dark:text-blue-500 hover:dark:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                </td>
                                @endhasrole
                                @can('forms delete')
                                <td class="py-4">
                                    <a wire:click="deleteForm({{ $form->id }})"
                                        class="flex justify-center text-red-600 hover:text-red-700 dark:text-red-500 hover:dark:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </a>
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $forms->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="modalRequest">
        <x-slot name="title">
            {{ __('Solicitar edición') }} <br>
            <span class="text-sm">Un analista revisará la solicitud y decidirá si aprobará el cambio.</span>
        </x-slot>
        <x-slot name="content">
            <x-label for="field">{{ __('Campo a actualizar') }}</x-label>
            <select id="field" wire:model.blur="incidentForm.fieldToChange"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Selecciona una opción</option>
                <option value="Primer Nombre">Primer Nombre</option>
                <option value="Segundo Nombre">Segundo Nombre</option>
                <option value="Primer apellido">Primer apellido</option>
                <option value="Segundo Apellido">Segundo Apellido</option>
                <option value="Dirección">Dirección</option>
                <option value="Teléfono">Teléfono</option>
                <option value="Poblado">Poblado</option>
                <option value="Colonia">Colonia</option>
                <option value="Sección">Sección</option>
            </select>
            <x-input-error for="incidentForm.fieldToChange" class="mt-2" />
            <x-label for="description" class="mt-4">{{ __('Descripción del cambio') }}</x-label>
            <textarea id="description" wire:model.blur="incidentForm.descriptionOfField" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Agrega aquí la corrección del campo elegido"></textarea>
            <x-input-error for="incidentForm.descriptionOfField" class="mt-2" />
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalRequest', false)" class="mr-2">Cancelar</x-secondary-button>
            <x-button wire:click="sendRequestOfFieldChange">Enviar</x-button>
        </x-slot>
    </x-dialog-modal>
</div>