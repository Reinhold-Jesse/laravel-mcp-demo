<?php

use App\Mcp\Servers\PublicServer;
use App\Mcp\Tools\CreateCustomerTool;
use App\Mcp\Tools\ListCustomersTool;
use App\Mcp\Tools\SendCustomerNotificationTool;
use App\Models\Customer;
use App\Models\User;
use App\Notifications\CustomerMessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

test('create customer tool validates email format', function () {
    $this->actingAs(User::factory()->create());

    PublicServer::tool(CreateCustomerTool::class, [
        'name' => 'Max Mustermann',
        'email' => 'ungueltig',
    ])->assertHasErrors();

    $this->assertDatabaseCount('customers', 0);
});

test('list customers tool returns minimized customer fields', function () {
    $this->actingAs(User::factory()->create());

    Customer::query()->create([
        'name' => 'Erika Muster',
        'email' => 'erika@example.com',
    ]);

    PublicServer::tool(ListCustomersTool::class)
        ->assertOk()
        ->assertSee(['Erika Muster', 'erika@example.com'])
        ->assertDontSee(['created_at', 'updated_at']);
});

test('customer notification is queueable', function () {
    expect(new CustomerMessageNotification('Hallo'))
        ->toBeInstanceOf(ShouldQueue::class);
});

test('send customer notification tool dispatches mail notification', function () {
    $this->actingAs(User::factory()->create());

    Notification::fake();

    $customer = Customer::query()->create([
        'name' => 'Reinhold',
        'email' => 'reinhold@example.com',
    ]);

    PublicServer::tool(SendCustomerNotificationTool::class, [
        'customer_id' => $customer->id,
        'message' => 'ich bin gerade an MCP dran',
    ])->assertOk()->assertSee('Benachrichtigung wurde gesendet.');

    Notification::assertSentTo(
        $customer,
        CustomerMessageNotification::class
    );
});
