<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Formularios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg md:p-4">
                <div class="grid grid-cols-4 gap-4 px-4 sm:px-0">
                    <!-- Titulo -->
                    <div class="col-span-4 md:col-span-2 xl:col-span-3">
                        <p class="text-xl dark:text-white text-center md:text-left">{{ $ownerUserName }}</p>
                    </div>
                    <!-- Botón agregar -->
                    @can('forms create')
                    <div
                        class="grid col-span-4 md:col-span-2 xl:col-span-1 row-span-1 justify-items-start md:justify-items-end">
                        <a href="{{ route('agregar-formulario') }}"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Agregar
                        </a>
                    </div>
                    @endcan
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
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Clave Electoral
                                </th>
                                @unlessrole('Data Capturer')
                                <th scope="col" class="px-6 py-3">
                                    Teléfono
                                </th>
                                @endunlessrole
                                @can('forms update')
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Editar</span>
                                </th>
                                @endcan
                                @hasrole('Data Capturer')
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Solicitar edición</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Ver</span>
                                </th>
                                @endhasrole
                                @can('forms delete')
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Eliminar</span>
                                </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($forms as $form)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-xs md:text-sm">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $form->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $form->first_name }} {{ $form->second_name }} {{
                                    $form->first_surname }} {{ $form->second_surname }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $form->electoral_key }}
                                </td>
                                @unlessrole('Data Capturer')
                                <td class="px-6 py-4">
                                    <a href="tel:{{ $form->phone }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{
                                        $form->phone }}</a>
                                </td>
                                @endunlessrole
                                @can('forms update')
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('editar-formulario', ['id' => $form->id]) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                </td>
                                @endcan
                                @hasrole('Data Capturer')
                                <td class="px-6 py-4 text-right">
                                    <button type="button" wire:click="openModalToChange({{ $form->id }})"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Solicitar
                                        edición</button>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('editar-formulario', ['id' => $form->id]) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                                </td>
                                @endhasrole
                                @can('forms delete')
                                <td class="px-6 py-4 text-right">
                                    <button type="button" wire:click="deleteForm({{ $form->id }})"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</button>
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