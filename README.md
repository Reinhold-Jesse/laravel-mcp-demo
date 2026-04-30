# Laravel MCP Demo

Dieses Projekt zeigt, wie ein MCP-Server in einer Laravel-Anwendung aufgebaut wird.
Der Endpunkt unter `/mcp` stellt Tools, Ressourcen und Prompts bereit, damit AI-Clients mit Kunden- und Produktdaten arbeiten koennen.

## Was die Demo zeigt

- MCP-Tooling fuer Suche, Erstellung und Benachrichtigung
- Read-only Ressourcen fuer strukturierten Datenkontext
- Prompt-Registrierung auf Server-Ebene
- Einfache Erweiterbarkeit durch eigene Tool- und Resource-Klassen

## Stack

- PHP `8.4`
- Laravel `13`
- `laravel/mcp`
- SQLite (lokal)
- Pest (Tests)
- Laravel Pint (Formatting)

## Schnellstart

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
composer run dev
```

Nach dem Start ist der MCP-Endpunkt unter `http://127.0.0.1:8000/mcp` erreichbar.

## MCP Einstieg im Code

- Route: `routes/ai.php`
- Server-Definition: `app/Mcp/Servers/PublicServer.php`
- Tools: `app/Mcp/Tools`
- Ressourcen: `app/Mcp/Resources`
- Prompts: `app/Mcp/Prompts`

Die Route ist bewusst schlank gehalten:

```php
Mcp::web('/mcp', \App\Mcp\Servers\PublicServer::class);
```

## Registrierte MCP Tools

Aktuell sind im Public Server folgende Tools registriert:

- `find_customer`
- `create_customer`
- `list_customers`
- `send_customer_notification`
- `find_product`
- `list_products`
- `create_product_restock_subscription`

Kurzlogik:

- Kunden suchen/erstellen und per Notification benachrichtigen
- Aktive Produkte suchen/listen
- Restock-Subscriptions nur fuer Produkte ohne Bestand anlegen

## Registrierte Ressourcen

- `ProductsResource`
  - URI: `file://resources/products.json`
  - MIME-Type: `application/json`
  - Liefert aktive Produkte inkl. Restock-Hinweisen

## Registrierte Prompts

- `ProductDiscoveryPrompt`

Damit kann ein MCP-Client wiederverwendbare Prompt-Bausteine direkt vom Server laden.

## Datenmodell (vereinfacht)

- `customers`: Stammdaten fuer Kunden
- `products`: Produktkatalog inkl. Lagerbestand und Aktiv-Status
- `product_restock_subscriptions`: E-Mail-Abos fuer nicht verfuegbare Produkte

## Lokale Entwicklung

Empfohlen:

```bash
composer run dev
```

Alternativ getrennt:

```bash
php artisan serve
php artisan queue:listen --tries=1
npm run dev
```

## Tests und Code Style

```bash
php artisan test --compact
vendor/bin/pint --dirty --format agent
```

## Troubleshooting

- MCP-Endpoint nicht erreichbar:
  - Route in `routes/ai.php` pruefen
  - App starten (`composer run dev` oder `php artisan serve`)
  - Direkt gegen `http://127.0.0.1:8000/mcp` testen

- Keine Daten sichtbar:
  - `php artisan migrate:fresh --seed`

- E-Mails kommen lokal nicht an:
  - `MAIL_*` in `.env` pruefen
  - lokal testweise `log`-Mailer verwenden

## Sicherheitshinweise

Die Demo ist absichtlich offen gehalten. Fuer produktive Nutzung sollten mindestens folgende Punkte umgesetzt werden:

- MCP-Endpoint authentifizieren und autorisieren
- Zugriff auf sensitive Tools rollenbasiert steuern
- Rate Limiting auf MCP-Routen aktivieren
- Tool-Aufrufe und Antworten auditierbar loggen

## Lizenz

MIT
