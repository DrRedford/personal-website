<?php

use App\Http\Controllers\Controller;
use App\Http\Middleware\HandleInertiaRequests;

arch('debugging helpers never reach the codebase')
    ->expect(['dd', 'dump', 'var_dump', 'ray', 'print_r', 'die', 'exit'])
    ->not->toBeUsed();

arch('controllers are invokable page controllers')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller')
    ->toExtend(Controller::class);

arch('middleware is named consistently')
    ->expect('App\Http\Middleware')
    ->toHaveMethod('handle')
    ->ignoring(HandleInertiaRequests::class);

/*
 * Resume content belongs in config/resume.php so it can be edited in one
 * place. Controllers should read it, not restate it.
 */
arch('controllers stay thin and return inertia responses')
    ->expect('App\Http\Controllers')
    ->toOnlyUse([
        'Inertia\Inertia',
        'Inertia\Response',
        'App\Http\Controllers\Controller',
        'config',
        'asset',
    ]);

arch()->preset()->php();

arch()->preset()->security();
