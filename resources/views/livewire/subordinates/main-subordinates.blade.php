<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Subordinados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col p-4 mb-4">
                    <p class="dark:text-gray-200 text-xl md:text-2xl">{{ $ownerUserName }}
                        <span
                            class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                            @switch($roleUserFromView)
                            @case('Super Administrator')
                            Super Administrador
                            @break
                            @case('Administrator')
                            Administrador
                            @break
                            @case('Supervisor')
                            Supervisor
                            @break
                            @case('Capture Analyst')
                            Analista
                            @break
                            @endswitch
                        </span>
                    </p>
                    <p class="dark:text-gray-200 text-base xl:text-xl">Rol de subordinados:
                        <span
                            class="bg-purple-100 text-purple-800 text-xs xl:text-sm font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">
                            @switch($roleUserFromView)
                            @case('Super Administrator')
                            Administrador
                            @break
                            @case('Administrator')
                            Supervisor
                            @break
                            @case('Supervisor')
                            Analista
                            @break
                            @case('Capture Analyst')
                            Capturista
                            @break
                            @endswitch
                        </span>
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
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Teléfono
                                </th>
                                <th scope="col" colspan="4" class="px-6 py-3 text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subordinates as $subordinate)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $subordinate->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $subordinate->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="tel:{{ $subordinate->phone }}"
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
                                @if(App\Models\User::find($userFromView)->hasrole('Supervisor'))
                                <td class="py-4">
                                    <a href="{{ route('panel-incidentes', ['id' => $subordinate->id]) }}"
                                        class="flex justify-center text-yellow-600 hover:text-yellow-700 dark:text-yellow-500 hover:dark:text-yellow-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="py-4">
                                    <a role="button" tabindex="0" wire:click="downloadCapturerPerAnalystListReport({{ $subordinate->id }})"
                                        class="flex justify-center text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                                @endif
                                <td class="py-4">
                                    <a href="{{ route('panel-formularios', ['id' => $subordinate->id]) }}"
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
                                @if(App\Models\User::find($userFromView)->hasanyrole('Capture Analyst|Data
                                Capturer'))
                                <td class="py-4">
                                    <a role="button" tabindex="0" wire:click="downloadCapturerReport({{ $subordinate->id }})"
                                        class="flex justify-center text-green-600 hover:text-green-700 dark:text-green-500 hover:dark:text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </td>
                                @else
                                <td class="py-4">
                                    <a href="{{ route('panel-subordinados', ['id' => $subordinate->id]) }}"
                                        class="flex justify-center text-blue-600 hover:text-blue-700 dark:text-blue-500 hover:dark:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path
                                                d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                                        </svg>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $subordinates->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>