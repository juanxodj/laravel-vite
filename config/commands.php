<?php

return [
    /*
    | Package settings
    */
    'settings' => [
        'route' => 'niceartisan',
        'middlewares' => [
            'web',
            // 'nice_artisan',
        ],
    ],

    /*
    | Available commands
    */
    'commands' => [

        /*
        | Make commands
        */
        'make' => [
            'make:cast',
            'make:channel',
            'make:command',
            'make:controller',
            'make:component',
            'make:event',
            'make:exception',
            'make:factory',
            'make:job',
            'make:listener',
            'make:mail',
            'make:middleware',
            'make:migration',
            'make:model',
            'make:notification',
            'make:observer',
            'make:policy',
            'make:provider',
            'make:request',
            'make:resource',
            'make:rule',
            'make:scope',
            'make:seeder',
            'make:test',
        ],

        /*
        | Migrate commands
        */
        'migrate' => [
            'migrate',
            'migrate:fresh',
            'migrate:install',
            'migrate:rollback',
            'migrate:reset',
            'migrate:refresh',
            'migrate:status',
        ],

        /*
        | Route commands
        */
        'route' => [
            'route:cache',
            'route:clear',
            'route:list',
        ],

        /*
        | Events commands
        */
        'events' => [
            'event:generate',
            'event:cache',
            'event:clear',
            'event:list',
        ],

        /*
        | Queue commands
        */
        'queue' => [
            'queue:table',
            'queue:failed',
            'queue:retry',
            'queue:forget',
            'queue:flush',
            'queue:failed-table',
            'queue:work',
            'queue:restart',
            //'queue:listen',
            'queue:subscribe',
            'queue:table',
            'queue:batches-table',
            'queue:retry-batch',
            'queue:prune-batches',
            'queue:monitor',
            'queue:prune-failed',
        ],

        /*
        | Config commands
        */
        'config' => [
            'config:cache',
            'config:clear',
        ],

        /*
        | Cache commands
        */
        'cache' => [
            'cache:clear',
            'cache:table',
            'view:cache',
        ],

        /*
        | Miscellaneous commands
        */
        'miscellaneous' => [
            'auth:clear-resets',
            'clear-compiled',
            'db:seed',
            'db:wipe',
            'down',
            'env',
            'key:generate',
            'optimize',
            'optimize:clear',
            'package:discover',
            'preset',
            'schedule:run',
            'schema:dump',
            'serve',
            'session:table',
            'storage:link',
            'vendor:publish',
            'view:clear',
            'stub:publish',
            'test',
            'model:prune',
            '_complete',
            'completion',
            'schedule:clear-cache',
        ],
    ],
];
