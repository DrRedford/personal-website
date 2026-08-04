<?php

use Inertia\Testing\AssertableInertia;

test('an unknown url returns a not found response', function () {
    $this->get('/this-page-does-not-exist')->assertNotFound();
});

/*
 * Every route on this site is read-only. If a write verb ever starts
 * resolving, something has been registered that should not have been.
 */
test('public pages reject write verbs', function (string $routeName) {
    $url = route($routeName);

    $this->post($url)->assertMethodNotAllowed();
    $this->put($url)->assertMethodNotAllowed();
    $this->delete($url)->assertMethodNotAllowed();
})->with(['home', 'experience', 'schooling', 'projects']);

test('the health check endpoint responds', function () {
    $this->get('/up')->assertOk();
});

/*
 * The first visit must return the full HTML document, since that is what
 * boots Inertia and loads the page component.
 */
test('a first visit returns the full html document', function (string $routeName) {
    $response = $this->get(route($routeName));

    $response->assertOk()
        ->assertSee('<!DOCTYPE html>', false)
        ->assertSee('id="app"', false);

    expect($response->headers->get('content-type'))->toContain('text/html');
})->with(['home', 'experience', 'schooling', 'projects']);

/*
 * Subsequent visits are XHR requests carrying the X-Inertia header and must
 * come back as a JSON page object instead of HTML.
 */
test('an inertia visit returns the page object as json', function (string $routeName, string $component) {
    /*
     * assertInertia() reads the page object out of the root view, so it only
     * applies to a first visit. An XHR visit returns the page object as the
     * JSON body instead, which is what gets asserted here.
     */
    $this->get(route($routeName), [
        'X-Inertia' => 'true',
        'X-Inertia-Version' => currentAssetVersion(),
    ])
        ->assertOk()
        ->assertHeader('x-inertia', 'true')
        ->assertJsonPath('component', $component)
        ->assertJsonPath('url', route($routeName, absolute: false))
        ->assertJsonPath('props.contact.email', config('resume.contact.email'));
})->with([
    ['home', 'Welcome'],
    ['experience', 'Experience'],
    ['schooling', 'Schooling'],
    ['projects', 'Projects'],
]);

/*
 * Asset versioning is what stops a visitor's cached JavaScript from running
 * against a newer set of props. A stale version must force a full reload
 * rather than quietly returning the new page object.
 */
test('a stale asset version forces the client to hard reload', function () {
    $this->get(route('home'), [
        'X-Inertia' => 'true',
        'X-Inertia-Version' => 'a-stale-build-hash',
    ])
        ->assertConflict()
        ->assertHeader('x-inertia-location', route('home'));
});

test('every page shares the application name for document titles', function (string $routeName) {
    $this->get(route($routeName))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->where('name', config('app.name'))
        );
})->with(['home', 'experience', 'schooling', 'projects']);

/*
 * Named routes are used by Wayfinder to generate the frontend's route
 * helpers, so the names and paths are part of the contract with the client.
 */
test('routes resolve to their expected paths', function (string $routeName, string $path) {
    expect(route($routeName, absolute: false))->toBe($path);
})->with([
    ['home', '/'],
    ['experience', '/experience'],
    ['schooling', '/schooling'],
    ['projects', '/projects'],
]);
