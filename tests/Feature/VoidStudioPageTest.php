<?php

test('the void studio page can be visited', function () {
    $response = $this->get(route('void-studio'));

    $response
        ->assertSuccessful()
        ->assertSee('Void Studio')
        ->assertSee('Logos, Websites und Branding')
        ->assertSee('Brand Core')
        ->assertSee('hello@void.studio');
});
