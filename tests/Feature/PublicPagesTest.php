<?php

use Inertia\Testing\AssertableInertia;

test('renders successfully', function (string $routeName) {
    $response = $this->get(route($routeName));

    $response->assertOk();
})->with([
    'home',
    'experience',
    'schooling',
    'projects',
]);

test('experience page receives resume data', function () {
    $this->get(route('experience'))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Experience')
            ->has('skills.0.category')
            ->has('skills.0.items')
            ->has('positions.0.company')
            ->has('positions.0.location')
            ->has('positions.0.roles.0.title')
            ->has('positions.0.roles.0.period')
            ->has('positions.0.highlights')
            ->has('otherPositions.0.company')
        );
});

test('experience page lists every role for a multi-role position', function () {
    $this->get(route('experience'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->where('positions.1.company', 'Hero Technical Solutions')
            ->has('positions.1.roles', 3)
        );
});
