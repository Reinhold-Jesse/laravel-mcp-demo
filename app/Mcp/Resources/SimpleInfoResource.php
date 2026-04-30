<?php

namespace App\Mcp\Resources;

use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class SimpleInfoResource extends Resource
{
    /**
     * The resource's description.
     */
    protected string $description = 'Simple MCP resource with basic project information.';

    /**
     * The resource's URI.
     */
    protected string $uri = 'file://resources/simple-info.md';

    /**
     * The resource's MIME type.
     */
    protected string $mimeType = 'text/markdown';

    /**
     * Handle the resource request.
     */
    public function handle(): Response
    {
        return Response::text(implode("\n", [
            '# Simple MCP Resource',
            '',
            'This is a minimal resource served by your Laravel MCP server.',
            '',
            '- App: laravel-mcp-demo',
            '- Environment: local',
            '- Purpose: quick MCP resource test',
        ]));
    }
}
