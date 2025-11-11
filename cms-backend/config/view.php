<?php

return [
    'paths' => [
        base_path('cms-backend/resources/views'),
    ],
    'compiled' => env(
        'VIEW_COMPILED_PATH',
        base_path('storage/framework/views')
    ),
];
