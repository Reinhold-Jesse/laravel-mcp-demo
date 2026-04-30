## Laravel MCP Demo

Dieses Projekt ist ein kleines Laravel-13-Demo-Projekt, das zeigt, wie man einen **MCP‑Server** mit dem Paket `laravel/mcp` baut und eigene **Tools** bereitstellt, die dann von AI‑Clients (z. B. Cursor, Claude Code, VS Code‑Erweiterungen) genutzt werden können.

Der Demo‑Server stellt vier einfache Kunden‑Tools zur Verfügung:

- **`find_customer`**: Sucht Kunden per Name.
- **`create_customer`**: Legt einen neuen Kunden an.
- **`list_customers`**: Listet alle Kunden alphabetisch auf.
- **`send_customer_notification`**: Sendet eine Nachricht an einen Kunden per E-Mail.

Alle Tools laufen über einen MCP‑Server unter dem Pfad **`/mcp`**.

---

### Voraussetzungen

- **PHP**: ^8.3
- **Laravel**: ^13.0 (Laravel 13 Skeleton)
- **Datenbank**: SQLite (im Projekt bereits vorkonfiguriert)
- **Composer**
- **Node.js & npm** (für Assets, falls benötigt)

Das Paket **`laravel/mcp`** ist bereits in `composer.json` eingetragen:

```json
"require": {
  "php": "^8.3",
  "laravel/framework": "^13.0",
  "laravel/mcp": "*",
  "laravel/tinker": "^3.0"
}
```

---

### Installation & lokales Setup

1. **Repository klonen**

   ```bash
   git clone <dein-repo-url> laravel-mcp-demo
   cd laravel-mcp-demo
   ```

2. **Composer-Abhängigkeiten installieren**

   ```bash
   composer install
   ```

3. **Environment anlegen & App-Key setzen**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **SQLite-Datenbank anlegen (falls nicht vorhanden)**

   ```bash
   touch database/database.sqlite
   ```

5. **Migrationen ausführen**

   ```bash
   php artisan migrate
   ```

6. (Optional) **Assets bauen**

   ```bash
   npm install
   npm run build
   ```

7. **Entwicklungsserver starten**

   ```bash
   php artisan serve
   ```

   Der MCP‑Endpoint ist dann z. B. unter `http://127.0.0.1:8000/mcp` erreichbar.

---

### MCP – Begriffe & Architektur

**MCP (Model Context Protocol)** ist ein Protokoll, mit dem AI‑Modelle externe Tools, Datenquellen und Server nutzen können. In diesem Projekt kommen folgende Grundbausteine zum Einsatz:

- **MCP-Server (`Server`)**: Eine PHP‑Klasse, die von `Laravel\Mcp\Server` erbt und Tools registriert.
- **MCP-Tool (`Tool`)**: Eine PHP‑Klasse, die von `Laravel\Mcp\Server\Tool` erbt, eine definierte JSON‑Schema‑Eingabe besitzt und eine Antwort (`Response`) liefert.
- **Request (`Laravel\Mcp\Request`)**: Kapselt die eingehende Tool‑Anfrage inkl. Parameter.
- **Response (`Laravel\Mcp\Response`)**: Baut die standardisierte Antwort für den MCP‑Client (JSON).
- **Schema (`Illuminate\Contracts\JsonSchema\JsonSchema`)**: Definiert die Eingabeparameter der Tools in maschinenlesbarer Form.
- **Route / Transport**: In `routes/ai.php` wird definiert, unter welcher URL der MCP‑Server verfügbar ist.

Die MCP‑Clients (Cursor, Claude, etc.) verbinden sich mit dieser URL und lesen die Tool‑Definitionen, Schemas und Beschreibungen automatisch aus.

---

### MCP-Routen & Server in diesem Projekt

Die MCP‑Route ist in `routes/ai.php` definiert:

```php
use Laravel\Mcp\Facades\Mcp;

Mcp::web('/mcp', \App\Mcp\Servers\PublicServer::class);
```

- **`Mcp::web('/mcp', ...)`**: Registriert einen HTTP‑Endpoint `/mcp`, der den MCP‑Server bereitstellt.
- **`PublicServer::class`**: Unsere konkrete Server‑Implementierung.

Der zugehörige MCP‑Server liegt in `app/Mcp/Servers/PublicServer.php`:

```php
class PublicServer extends Server
{
    protected string $name = 'Demo MCP Server';

    /**
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        FindCustomerTool::class,
        CreateCustomerTool::class,
        ListCustomersTool::class,
        SendCustomerNotificationTool::class,
    ];
}
```

- **`$name`**: Anzeigename des Servers im Client.
- **`$tools`**: Liste aller verfügbaren Tool‑Klassen.

---

### Tool-Definitionen im Detail

Alle Tools finden sich unter `app/Mcp/Tools`.

#### `find_customer`

Datei: `app/Mcp/Tools/FindCustomerTool.php`

- **Name**: `find_customer`
- **Beschreibung**: „Sucht Kunden nach Namen“
- **Eingabe-Schema**:
  - `name` – `string` – Suchbegriff für den Kundennamen
- **Verhalten**:
  - Liest den Parameter `name` aus dem Request.
  - Führt eine `like`‑Suche auf dem `Customer`‑Model durch.
  - Gibt ein JSON‑Array aller passenden Kunden zurück.

Das Schema ist wie folgt definiert:

```php
public function schema(JsonSchema $schema): array
{
    return [
        'name' => $schema->string(),
    ];
}
```

Die eigentliche Logik steckt in `handle(Request $request): Response`.

#### `create_customer`

Datei: `app/Mcp/Tools/CreateCustomerTool.php`

- **Name**: `create_customer`
- **Beschreibung**: „Legt neuen Kunden an“
- **Eingabe-Schema**:
  - `name` – `string`, required, max 255
  - `email` – `string`, optional, max 255
- **Verhalten**:
  - Validiert die Eingabe per `$request->validate([...])`.
  - Legt per `Customer::create($data)` einen neuen Datensatz an.
  - Gibt ein JSON‑Objekt mit `success: true` und den Kundendaten zurück.

Schema:

```php
public function schema(JsonSchema $schema): array
{
    return [
        'name' => $schema->string(),
        'email' => $schema->string(),
    ];
}
```

#### `list_customers`

Datei: `app/Mcp/Tools/ListCustomersTool.php`

- **Name**: `list_customers`
- **Beschreibung**: „Listet alle Kunden auf“
- **Eingabe-Schema**:
  - Keine Eingaben (leeres Schema-Array)
- **Verhalten**:
  - Holt alle `Customer`‑Einträge aus der Datenbank.
  - Sortiert nach `name`.
  - Gibt ein JSON‑Array aller Kunden zurück:
    - `success: true`
    - `data: [...]` mit der Liste der Kunden.

Schema:

```php
public function schema(JsonSchema $schema): array
{
    // Dieses Tool erwartet keine Eingaben.
    return [];
}
```

#### `send_customer_notification`

Datei: `app/Mcp/Tools/SendCustomerNotificationTool.php`

- **Name**: `send_customer_notification`
- **Beschreibung**: „Sendet eine Nachricht an einen Kunden per E-Mail“
- **Eingabe-Schema**:
  - `customer_id` – `integer`, required, muss in `customers.id` existieren
  - `message` – `string`, required, max 2000 Zeichen
- **Verhalten**:
  - Lädt den Kunden über die ID.
  - Prüft, ob eine E-Mail-Adresse hinterlegt ist.
  - Sendet die Nachricht als Laravel Notification per Mail.
  - Gibt ein JSON mit `success`, Statusmeldung und Kundendaten zurück.

---

### Wie ein MCP-Client diesen Server sieht

Ein typischer MCP‑Client (z. B. Cursor oder Claude Code) wird:

- Den Server unter `http://127.0.0.1:8000/mcp` ansprechen.
- Zunächst die **Server-Metadaten** lesen:
  - Server‑Name (`Demo MCP Server`)
  - Liste der Tools (`find_customer`, `create_customer`, `list_customers`, `send_customer_notification`)
- Zu jedem Tool:
  - **Name** (`name`)
  - **Beschreibung** (`description` oder `#[Description]`‑Attribut)
  - **JSON-Schema** der Eingabeparameter (über `schema()`).

Auf Basis dieser Informationen generiert der Client z. B. Eingabemasken oder nutzt die Tools autonom innerhalb eines AI‑Flows.

---

### Beispiel: MCP in Cursor konfigurieren

> Hinweis: Die konkrete UI kann sich ändern, das Prinzip bleibt aber gleich.

1. **Laravel-Server starten**

   ```bash
   php artisan serve
   ```

2. **In Cursor einen neuen MCP-Server eintragen**

   - Öffne die Einstellungen für MCP/Tools.
   - Füge einen neuen HTTP‑MCP‑Server hinzu, z. B.:
     - **Name**: `laravel-mcp-demo`
     - **URL**: `http://127.0.0.1:8000/mcp`

3. **Verbindung testen**

   - Cursor sollte den Servernamen `Demo MCP Server` anzeigen.
   - In den Tool‑Listen sollten `find_customer`, `create_customer`, `list_customers` und `send_customer_notification` sichtbar sein.

4. **Tools aus dem Chat nutzen**

   - Im Chat mit dem AI‑Modell kannst du z. B. schreiben:
     - „Nutze das Tool `create_customer`, um einen Kunden mit Name `Max Mustermann` anzulegen.“
   - Der Client sendet dann intern eine MCP‑Tool‑Anfrage an deinen Laravel‑Server.

---

### Beispiel: Rohes Tool-Request/Response-Format (vereinfacht)

> Nur zur Veranschaulichung – echte Payloads können leicht abweichen, je nach MCP‑Client.

**Tool-Request** (vereinfacht):

```json
{
  "tool": "create_customer",
  "arguments": {
    "name": "Max Mustermann",
    "email": "max@example.com"
  }
}
```

**Tool-Response** (vereinfacht, wie `CreateCustomerTool` sie zurückgibt):

```json
{
  "success": true,
  "customer": {
    "id": 1,
    "name": "Max Mustermann",
    "email": "max@example.com"
  }
}
```

---

### Eigene MCP-Tools ergänzen

Um weitere Tools hinzuzufügen:

1. **Neue Tool-Klasse anlegen**

   - Erzeuge eine neue Klasse unter `app/Mcp/Tools`, die von `Laravel\Mcp\Server\Tool` erbt.
   - Setze:
     - `public string $name`
     - `public string $description`
     - `public function schema(JsonSchema $schema): array`
     - `public function handle(Request $request): Response`

2. **Tool im Server registrieren**

   - Ergänze die Klasse im Array `$tools` in `PublicServer`:

   ```php
   protected array $tools = [
       FindCustomerTool::class,
       CreateCustomerTool::class,
       ListCustomersTool::class,
       \App\Mcp\Tools\DeinNeuesTool::class,
   ];
   ```

3. **Server neu starten / Caches leeren, falls nötig**

   - MCP‑Clients sollten das neue Tool beim nächsten Refresh automatisch erkennen.

---

### Sicherheit & Zugriff

- Der Demo‑Server ist bewusst simpel gehalten und ohne Authentifizierung.
- Für produktive Umgebungen solltest du:
  - Den Zugriff auf den MCP‑Endpoint (`/mcp`) absichern (Auth, IP‑Whitelist, VPN, etc.).
  - Tools nur die Berechtigungen geben, die wirklich nötig sind.
  - Eingaben strikt validieren (wie im Demo‑Code mit `$request->validate()`).

---

### Lizenz

Dieses Projekt basiert auf dem Laravel‑Skeleton und steht damit unter der **MIT‑Lizenz**.
