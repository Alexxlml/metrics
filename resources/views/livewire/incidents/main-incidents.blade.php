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
                    <p class="dark:text-gray-200 text-md">Usa el enlace <span class="font-bold">"Editar"</span> para ir
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
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Editar Formulario</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Cambiar estado</span>
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
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button type="button" wire:click="openModalToChange({{ $incident->id }})"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Cambiar
                                        estado</button>
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