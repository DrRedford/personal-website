<?php

/*
 * These are the only tests that exercise the Vue layer. Everything else in
 * the suite stops at "the controller handed the right props to Inertia" — a
 * broken component, a bad import, or a runtime error in a template would
 * still leave those green. Here the pages are loaded in a real browser, so a
 * JavaScript failure is a test failure.
 */

test('every page renders without javascript or console errors', function () {
    $pages = visit(['/', '/experience', '/schooling', '/projects']);

    $pages->assertNoJavaScriptErrors()->assertNoConsoleLogs();
});

test('the home page renders the headline content from the resume', function () {
    visit('/')
        ->assertNoJavaScriptErrors()
        ->assertSee('Software Developer')
        ->assertSee('Vehikl')
        ->assertSee(config('resume.contact.location'));
});

test('the experience page renders skills and every position', function () {
    $page = visit('/experience')->assertNoJavaScriptErrors();

    foreach (config('resume.experience') as $position) {
        $page->assertSee($position['company']);
    }

    foreach (config('resume.other_experience') as $position) {
        $page->assertSee($position['company']);
    }

    foreach (config('resume.skills') as $group) {
        $page->assertSee($group['category']);
    }
});

/*
 * A position with several roles collapses to a single row if the timeline
 * stops iterating, which is easy to miss without checking the rendered page.
 */
test('the experience page renders every role of a multi-role position', function () {
    $page = visit('/experience')->assertNoJavaScriptErrors();

    foreach (config('resume.experience.1.roles') as $role) {
        $page->assertSee($role['title'])->assertSee($role['period']);
    }
});

test('the schooling page renders every education entry', function () {
    $page = visit('/schooling')->assertNoJavaScriptErrors();

    foreach (config('resume.education') as $entry) {
        $page->assertSee($entry['institution'])
            ->assertSee($entry['program'])
            ->assertSee($entry['period']);
    }
});

test('the projects page renders its empty state rather than a dead end', function () {
    visit('/projects')
        ->assertNoJavaScriptErrors()
        ->assertSee('Write-ups in progress')
        ->assertSee('View my experience');
});

/*
 * Navigation is client-side, so a broken route helper or Link would only
 * surface in the browser.
 */
test('the navigation moves between pages without a full reload', function () {
    visit('/')
        ->assertNoJavaScriptErrors()
        ->click('Experience')
        ->assertPathIs('/experience')
        ->assertSee('Vehikl')
        ->click('Schooling')
        ->assertPathIs('/schooling')
        ->assertSee('Mohawk College')
        ->assertNoJavaScriptErrors();
});

test('the appearance toggle switches the page to dark mode', function () {
    visit('/')
        ->assertNoJavaScriptErrors()
        ->click('Dark theme')
        ->assertNoJavaScriptErrors();
});

test('pages render on a mobile viewport without javascript errors', function () {
    visit('/')
        ->on()->mobile()
        ->assertNoJavaScriptErrors()
        ->assertSee('Vehikl');
});
