<?php

namespace App\Mcp\Servers;

use App\Mcp\Prompts\ProductDiscoveryPrompt;
use App\Mcp\Resources\ProductsResource;
use App\Mcp\Tools\CreateCustomerTool;
use App\Mcp\Tools\CreateProductRestockSubscriptionTool;
use App\Mcp\Tools\FindCustomerTool;
use App\Mcp\Tools\FindProductTool;
use App\Mcp\Tools\ListCustomersTool;
use App\Mcp\Tools\ListProductsTool;
use App\Mcp\Tools\SendCustomerNotificationTool;
use Illuminate\Support\Facades\Auth;
use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Prompt;
use Laravel\Mcp\Server\ServerContext;
use Laravel\Mcp\Server\Tool;

class PublicServer extends Server
{
    protected string $name = 'Demo MCP Server';

    /**
     * If false, all tools are available without authentication.
     */
    protected bool $authRequired = false;

    protected string $instructions = <<<'MARKDOWN'
        Antworte ausschliesslich auf Deutsch (de-DE).
        Du bist ein MCP-Assistent fuer diese Laravel-Anwendung.
        Gib ausschliesslich finale Nutzerausgabe aus.
        Zeige niemals internen Denkprozess, Reasoning, Analyse, Plan, Tool-Schritte, JSON-Rohdaten oder Meta-Erklaerungen.
        Schreibe niemals Formulierungen wie "Gedanke:", "Analyse:", "Ich sollte ...", "Das Tool ...", "Der Benutzer ...".
        Schreibe niemals Saetze ueber deine Absicht oder deinen naechsten Schritt, z. B. "Ich werde ...", "Ich antworte ...", "Ich bestaetige ...".
        Beginne die Antwort niemals mit "Ich werde", "Ich antworte", "Ich bestaetige" oder aehnlichen Meta-Phrasen.
        Ausgabeformat: genau der finale Nutztext ohne Einleitung, ohne Erklaerung, ohne Meta-Kommentar.
        Wenn Informationen fehlen, stelle genau eine kurze Rueckfrage.
    MARKDOWN;

    /**
     * @var array<int, class-string<Tool>>
     */
    protected array $guestTools = [
        FindProductTool::class,
        CreateProductRestockSubscriptionTool::class,
        ListProductsTool::class,
    ];

    /**
     * The tools registered with this MCP server.
     *
     * @var array<int, class-string<Tool>>
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
     * @var array<int, class-string<Server\Resource>>
     */
    protected array $resources = [
        ProductsResource::class,
    ];

    /**
     * The prompts registered with this MCP server.
     *
     * @var array<int, class-string<Prompt>>
     */
    protected array $prompts = [
        ProductDiscoveryPrompt::class,
    ];

    public function createContext(): ServerContext
    {
        $context = parent::createContext();

        $tools = $this->tools;

        if ($this->authRequired && ! Auth::check()) {
            $tools = $this->guestTools;
        }

        return new ServerContext(
            supportedProtocolVersions: $context->supportedProtocolVersions,
            serverCapabilities: $context->serverCapabilities,
            serverName: $context->serverName,
            serverVersion: $context->serverVersion,
            instructions: $context->instructions,
            maxPaginationLength: $context->maxPaginationLength,
            defaultPaginationLength: $context->defaultPaginationLength,
            tools: $tools,
            resources: $this->resources,
            prompts: $this->prompts,
        );
    }
}
