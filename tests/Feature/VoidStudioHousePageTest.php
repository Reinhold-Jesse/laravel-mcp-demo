<?php

test('the void studio house landing page can be visited', function () {
    $response = $this->get(route('void-studio-house'));

    $response
        ->assertSuccessful()
        ->assertSee('Void Studio', false)
        ->assertSee('Software, die', false)
        ->assertSee('mitdenkt', false)
        ->assertSee('KI-Agenten', false)
        ->assertSee('Kontakt', false);
});
