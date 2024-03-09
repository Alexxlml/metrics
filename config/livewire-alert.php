<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert' => [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false,
        'customClass' => [
            'popup' => 'dark:bg-gray-800 dark:text-gray-300',
            'timerProgressBar' => 'bg-indigo-500',
        ],
    ],
    'confirm' => [
        'icon' => 'warning',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'No',
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33',
        'customClass' => [
            'popup' => 'dark:bg-gray-800 dark:text-gray-300',
        ],
    ],
    'success' => [
        'position' => 'center',
        'timer' => 4000,
        'toast' => false,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false,
        'customClass' => [
            'popup' => 'dark:bg-gray-800 dark:text-gray-300',
            'timerProgressBar' => 'bg-indigo-500',
        ],
    ],
    'error' => [
        'position' => 'top-end',
        'timer' => 4000,
        'toast' => false,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false,
        'customClass' => [
            'popup' => 'dark:bg-gray-800 dark:text-gray-300',
            'timerProgressBar' => 'bg-indigo-500',
        ],
    ],
];
