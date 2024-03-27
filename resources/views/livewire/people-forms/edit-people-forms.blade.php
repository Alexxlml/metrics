<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if(auth()->user()->hasrole('Data Capturer'))
            {{ __('Visualizar Formulario') }}
            @else
            {{ __('Editar Formulario') }}
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    <x-form-section submit="save">
                        <x-slot name="title">
                            {{ __('Información personal') }}
                        </x-slot>
                        <x-slot name="description">
                        </x-slot>
                        <x-slot name="form">
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="first_name">{{ __('Primer Nombre') }}</x-label>
                                <x-input id="first_name" type="text" class="w-full" wire:model="firstName" />
                                <x-input-error for="firstName" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="second_name">{{ __('Segundo Nombre') }}</x-label>
                                <x-input id="second_name" type="text" class="w-full" wire:model.blur="secondName" />
                                <x-input-error for="secondName" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="first_surname">{{ __('Primer Apellido') }}</x-label>
                                <x-input id="first_surname" type="text" class="w-full" wire:model.blur="firstSurName" />
                                <x-input-error for="firstSurName" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="second_surname">{{ __('Segundo Apellido') }}</x-label>
                                <x-input id="second_surname" type="text" class="w-full"
                                    wire:model.blur="secondSurName" />
                                <x-input-error for="secondSurName" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="electoral_key">{{ __('Clave Electoral') }}</x-label>
                                <x-input id="electoral_key" type="text" class="w-full cursor-not-allowed pointer-events-none disabled:opacity-50"
                                    wire:model.blur="electoral_key" disabled/>
                                <x-input-error for="electoral_key" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="phone">{{ __('Teléfono') }}</x-label>
                                <x-input id="phone" type="tel" class="w-full" wire:model.blur="phone" />
                                <x-input-error for="phone" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <x-label for="address">{{ __('Dirección') }}</x-label>
                                <x-input id="address" type="text" class="w-full" wire:model.blur="address" />
                                <x-input-error for="address" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="town_id">{{ __('Poblado') }}</x-label>
                                <select id="town_id" wire:model.blur="selectedTown"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Selecciona</option>
                                    @foreach($towns as $town)
                                    <option value="{{ $town->id }}">{{ $town->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="selectedTown" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="neighborhood_id">{{ __('Colonia') }}</x-label>
                                <select id="neighborhood_id" wire:model.blur="selectedNeighborhood"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Selecciona</option>
                                    @foreach($neighborhoods as $neighborhood)
                                    <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="selectedNeighborhood" class="mt-2" />
                            </div>
                        </x-slot>
                        <x-slot name="actions">
                            <x-secondary-button class="mr-2" wire:click="redirectToPanel">{{ __('Regresar al
                                panel')}}</x-secondary-button>
                            @can('forms update')
                            <x-button wire:loading.attr="disabled">
                                {{ __('Save') }}
                            </x-button>
                            @endcan
                        </x-slot>
                    </x-form-section>
                </div>
            </div>
        </div>
    </div>
</div>