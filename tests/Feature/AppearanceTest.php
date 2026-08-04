<?php

/*
 * HandleAppearance reads the `appearance` cookie and shares it with the root
 * Blade view, which applies the `dark` class before the first paint so the
 * page never flashes light. The cookie is exempt from encryption in
 * bootstrap/app.php, so these tests send it unencrypted.
 */

test('the dark class is applied when the appearance cookie is dark', function () {
    $this->withUnencryptedCookie('appearance', 'dark')
        ->get(route('home'))
        ->assertOk()
        ->assertSee('class="dark"', false);
});

test('the dark class is omitted for light and system', function (string $appearance) {
    $this->withUnencryptedCookie('appearance', $appearance)
        ->get(route('home'))
        ->assertOk()
        ->assertDontSee('class="dark"', false);
})->with(['light', 'system']);

test('appearance defaults to system when no cookie is set', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('class="dark"', false)
        // The inline script reads this value to honour the OS preference.
        ->assertSee("const appearance = 'system';", false);
});

test('the appearance cookie value reaches the inline no-flash script', function () {
    $this->withUnencryptedCookie('appearance', 'dark')
        ->get(route('home'))
        ->assertSee("const appearance = 'dark';", false);
});

/*
 * The middleware shares the value on every request, not just the home page,
 * because the root template is the same for all of them.
 */
test('appearance is handled on every page', function (string $routeName) {
    $this->withUnencryptedCookie('appearance', 'dark')
        ->get(route($routeName))
        ->assertOk()
        ->assertSee('class="dark"', false);
})->with(['home', 'experience', 'schooling', 'projects']);
