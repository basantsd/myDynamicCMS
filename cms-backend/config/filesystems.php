<?php

return [
    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => base_path('storage/app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => base_path('storage/app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
    ],

    'links' => [
        base_path('public/storage') => base_path('storage/app/public'),
    ],
];
