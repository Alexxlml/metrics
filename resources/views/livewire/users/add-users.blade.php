<div>
    <div class="p-4">
        <x-form-section submit="save">
            <x-slot name="title">
                {{ __('Información personal') }}
            </x-slot>
            <x-slot name="description">
                {{ __('Rellena el formulario con los datos solicitados.') }}
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
                    <x-input id="second_surname" type="text" class="w-full" wire:model.blur="secondSurName" />
                    <x-input-error for="secondSurName" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-label for="phone">{{ __('Teléfono') }}</x-label>
                    <x-input id="phone" type="tel" class="w-full" wire:model.blur="phone" />
                    <x-input-error for="phone" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-label for="role_id">{{ __('Rol') }}</x-label>
                    <select id="role_id" wire:model.blur="selectedRole"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecciona</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="selectedRole" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-secondary-button class="mr-2" wire:click="redirectToPanel">{{ __('Regresar al
                    panel')}}</x-secondary-button>
                <x-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
</div>