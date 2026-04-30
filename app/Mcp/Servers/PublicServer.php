<?php

namespace App\Mcp\Servers;

use App\Mcp\Resources\ProductsResource;
use App\Mcp\Resources\SimpleInfoResource;
use App\Mcp\Tools\CreateCustomerTool;
use App\Mcp\Tools\CreateProductRestockSubscriptionTool;
use App\Mcp\Tools\FindCustomerTool;
use App\Mcp\Tools\FindProductTool;
use App\Mcp\Tools\ListCustomersTool;
use App\Mcp\Tools\ListProductsTool;
use App\Mcp\Tools\SendCustomerNotificationTool;
use Laravel\Mcp\Server;

class PublicServer extends Server
{
    protected string $name = 'Demo MCP Server';

    /**
     * The tools registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */    
    protected array $tools = [
        FindCustomerTool::class,
        FindProductTool::class,
        CreateCustomerTool::class,
        CreateProductRestockSubscriptionTool::class,
        ListCustomersTool::class,
        ListProductsTool::class,
        SendCustomerNotificationTool::class,
    ];

    /**
     * The resources registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Resource>>
     */
    protected array $resources = [
        SimpleInfoResource::class,
        ProductsResource::class,
    ];
 
    /**
     * The prompts registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Prompt>>
     */
    protected array $prompts = [
       //
    ];
}
