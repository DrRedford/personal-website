<?php

use Illuminate\Support\Facades\Schema;
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

/*
 * The test suite runs with SESSION_DRIVER=array, so it would not otherwise
 * exercise the database session handler that production actually uses.
 */
test('renders successfully using the database session driver', function (string $routeName) {
    config()->set('session.driver', 'database');

    $this->get(route($routeName))->assertOk();
})->with([
    'home',
    'experience',
    'schooling',
    'projects',
]);

test('sessions table has every column the database session driver writes', function () {
    expect(Schema::hasColumns('sessions', [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ]))->toBeTrue();
});

test('home page receives hero content derived from the resume', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Welcome')
            ->where('summary', config('resume.summary'))
            ->where('location', config('resume.contact.location'))
            ->where('currentRole.title', 'Software Developer')
            ->where('currentRole.company', 'Vehikl')
            ->where('resumeUrl', asset(config('resume.pdf')))
        );
});

test('the downloadable resume exists in the public directory', function () {
    expect(public_path(config('resume.pdf')))->toBeReadableFile();
});

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

test('schooling page receives education data', function () {
    $this->get(route('schooling'))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Schooling')
            ->has('education', 2)
            ->has('education.0.institution')
            ->has('education.0.location')
            ->has('education.0.program')
            ->has('education.0.period')
            // Pins most-recent-first ordering, which the timeline relies on.
            ->where('education.0.period', '2021 – 2023')
        );
});

test('experience page lists every role for a multi-role position', function () {
    $this->get(route('experience'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->where('positions.1.company', 'Hero Technical Solutions')
            ->has('positions.1.roles', 3)
        );
});
