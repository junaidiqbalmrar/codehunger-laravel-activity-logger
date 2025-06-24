<?php

return [
    'storage' => 'database', // or 'log'
    'cleanup_days' => 30,
    'log_events' => [
        'login' => true,
        'logout' => true,
        'registered' => true,
        'model_updated' => true,
        'model_deleted' => true,
    ],
];
