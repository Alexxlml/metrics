<div class="p-4">
    <x-form-section submit="save">
        <x-slot name="title">
            {{ __('Asignación de Jerarquía') }}
        </x-slot>
        <x-slot name="description">
            {{ __('Elige un rol y un jefe. Después el rol del subordinado y el subordinado que asignarás.') }}
        </x-slot>
        <x-slot name="form">
            <!-- Rol del jefe -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="boss_role" value="{{ __('Rol del Jefe') }}" />
                <select id="boss_role" wire:model.live="selectedBossRoleForAdd"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Selecciona un Rol</option>
                    @foreach($boss_roles as $boss_role)
                    <option value="{{ $boss_role->name }}">{{ $boss_role->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="selectedBossRoleForAdd" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="boss_user" value="{{ __('Nombre del Jefe') }}" />
                <select id="boss_user" wire:model.live="selectedBossIdForAdd" wire:key="selectedBossRoleForAdd"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Selecciona un Jefe</option>
                    @if($selectedBossRoleForAdd)
                    @foreach(App\Models\User::role($selectedBossRoleForAdd)->get() as $boss_user)
                    <option value="{{ $boss_user->id }}">{{ $boss_user->name }}</option>
                    @endforeach
                    @endif
                </select>
                <x-input-error for="selectedBossIdForAdd" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="subordinate_role" value="{{ __('Rol del Subordinado') }}" />
                <select id="subordinate_role" wire:model.live="selectedSubordinateRoleForAdd"
                    wire:key="{{ $selectedBossRoleForAdd }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Selecciona un Rol</option>
                    @if($selectedBossRoleForAdd)
                    @foreach(Spatie\Permission\Models\Role::where('id',Spatie\Permission\Models\Role::where('name',
                    $selectedBossRoleForAdd)->first()->id+1)->get() as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                    @endif
                </select>
                <x-input-error for="selectedSubordinateRoleForAdd" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="subordinate_name" value="{{ __('Nombre del Subordinado') }}" />
                <select id="subordinate_name" wire:model.live="selectedSubordinateIdForAdd"
                    wire:key="selectedSubordinateRoleForAdd"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Selecciona un subordinado</option>
                    @if($selectedSubordinateRoleForAdd != '')
                    @foreach(App\Models\User::role($selectedSubordinateRoleForAdd)->get()
                    as $subordinate)
                    <option value="{{ $subordinate->id }}">{{ $subordinate->name }}</option>
                    @endforeach
                    @endif
                </select>
                <x-input-error for="selectedSubordinateIdForAdd" class="mt-2" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>
            <a href="{{ route('panel-jerarquias') }}"
                class="inline-flex items-center mx-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Regresar
                al panel</a>
            <x-button wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>