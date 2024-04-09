<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Incidentes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col p-4 mb-4">
                    <h1 class="dark:text-gray-200 text-2xl">{{ $ownerUserName }}</h1>
                    <p class="dark:text-gray-200 text-md mt-3">Usa el enlace <span class="font-bold">"Editar"</span> para ir
                        al formulario y realizar la corrección.<br>
                        <span class="font-bold">"Cambia el estado"</span> de la incidencia si la corrección fue
                        realizada o rechazada.
                    </p>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 sm:px-0">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    ID Formulario
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Subordinado
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Campo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Descripción
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Estado
                                </th>
                                <th scope="col" colspan="2" class="px-6 py-3 text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incidents as $incident)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $incident->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $incident->form_id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ App\Models\User::find($incident->subordinate_id)->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $incident->field_to_change }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $incident->description_of_field }}
                                </td>
                                <td class="px-6 py-4">
                                    @switch($incident->status)
                                    @case('pendiente')
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                        @break
                                        @case('realizada')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                            @break
                                            @case('rechazada')
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                @break
                                                @default
                                                @endswitch
                                                {{ $incident->status }}
                                            </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('editar-formulario', ['id' => $incident->form_id]) }}"
                                        class="flex justify-center text-blue-600 hover:text-blue-700 dark:text-blue-500 hover:dark:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z"
                                                clip-rule="evenodd" />
                                            <path
                                                d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button type="button" wire:click="openModalToChange({{ $incident->id }})"
                                        class="flex justify-center text-yellow-600 hover:text-yellow-700 dark:text-yellow-500 hover:dark:text-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $incidents->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
    <x-dialog-modal wire:model="changeStateModal">
        <x-slot name="title">
            {{ __('Cambiar estado de la incidencia') }}
        </x-slot>
        <x-slot name="content">
            <x-label for="state_selected">{{ __('Estado de la incidencia')}}</x-label>
            <select id="state_selected" wire:model.blur="statusToChange"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Selecciona una opción</option>
                @foreach($statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
            <x-input-error for="statusToChange" class="mt-2" />
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('changeStateModal', false)" class="mr-2">Cancelar</x-secondary-button>
            <x-button wire:click="changeStateOfIncident">Enviar</x-button>
        </x-slot>
    </x-dialog-modal>
</div>