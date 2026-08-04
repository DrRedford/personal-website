<?php

/*
 * The whole site is driven by config/resume.php. A missing key does not raise
 * a PHP error: the controller passes null straight through to Inertia and Vue
 * renders a blank row. These tests turn that silent breakage into a failure.
 */

test('contact details are present and usable', function () {
    expect(config('resume.contact.location'))->toBeString()->not->toBeEmpty()
        ->and(config('resume.contact.email'))->toBeString()->not->toBeEmpty();

    // The Projects and Welcome pages build a mailto: link from this value.
    expect(filter_var(config('resume.contact.email'), FILTER_VALIDATE_EMAIL))
        ->not->toBeFalse();
});

test('the summary shown on the home page is present', function () {
    expect(config('resume.summary'))->toBeString()->not->toBeEmpty();
});

test('the downloadable resume path is set and the file exists', function () {
    expect(config('resume.pdf'))->toBeString()->not->toBeEmpty()
        ->and(public_path(config('resume.pdf')))->toBeReadableFile();
});

test('every skill group has a category and at least one item', function () {
    expect(config('resume.skills'))->not->toBeEmpty();

    foreach (config('resume.skills') as $index => $group) {
        expect($group)->toHaveKeys(['category', 'items'], "skills.{$index}")
            ->and($group['category'])->toBeString()->not->toBeEmpty()
            ->and($group['items'])->toBeArray()->not->toBeEmpty();

        foreach ($group['items'] as $item) {
            expect($item)->toBeString()->not->toBeEmpty();
        }
    }
});

/*
 * Both experience lists render through the same timeline component, so they
 * have to satisfy the same shape.
 */
test('every position has the shape the experience timeline renders', function (string $key) {
    $positions = config("resume.{$key}");

    expect($positions)->toBeArray()->not->toBeEmpty();

    foreach ($positions as $index => $position) {
        $context = "{$key}.{$index}";

        expect($position)->toHaveKeys(['company', 'location', 'roles', 'highlights'], $context)
            ->and($position['company'])->toBeString()->not->toBeEmpty()
            ->and($position['location'])->toBeString()->not->toBeEmpty()
            ->and($position['roles'])->toBeArray()->not->toBeEmpty()
            ->and($position['highlights'])->toBeArray()->not->toBeEmpty();

        foreach ($position['roles'] as $role) {
            expect($role)->toHaveKeys(['title', 'period'], $context)
                ->and($role['title'])->toBeString()->not->toBeEmpty()
                ->and($role['period'])->toBeString()->not->toBeEmpty();
        }

        foreach ($position['highlights'] as $highlight) {
            expect($highlight)->toBeString()->not->toBeEmpty();
        }
    }
})->with(['experience', 'other_experience']);

test('every education entry has the shape the education timeline renders', function () {
    expect(config('resume.education'))->toBeArray()->not->toBeEmpty();

    foreach (config('resume.education') as $index => $entry) {
        expect($entry)->toHaveKeys(['institution', 'location', 'program', 'period'], "education.{$index}");

        foreach ($entry as $field => $value) {
            expect($value)->toBeString()->not->toBeEmpty("education.{$index}.{$field}");
        }
    }
});

/*
 * HomeController derives the headline role from the first entry of
 * resume.experience, so that entry has to be reachable and complete.
 */
test('the first experience entry can populate the home page headline', function () {
    $position = config('resume.experience')[0] ?? null;

    expect($position)->not->toBeNull()
        ->and($position['company'])->toBeString()->not->toBeEmpty()
        ->and($position['roles'][0]['title'] ?? null)->toBeString()->not->toBeEmpty();
});

/*
 * Both timelines render newest first without sorting, so the ordering has to
 * hold in the config itself.
 */
test('positions and education are ordered most recent first', function () {
    // TODO: assert the ordering. Left unwritten, this reported as a risky test
    // (a test with no assertions), which is indistinguishable from a passing
    // one in CI output.
})->skip('Ordering assertion not written yet.');
