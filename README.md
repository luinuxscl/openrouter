# Servicio OpenRouter para Laravel

Este paquete proporciona una integración sencilla con la API de OpenRouter para proyectos Laravel, permitiendo la conexión con múltiples modelos de IA a través de una interfaz unificada.

## Instalación

### 1. Agregar el repositorio a composer.json

Si no lo has hecho aún, asegúrate de que tu `composer.json` tenga configurado el repositorio de paquetes locales:

```json
"repositories": [
    {
        "type": "path",
        "url": "./packages/*"
    }
]
```

### 2. Instalar el paquete

```bash
composer require luinuxscl/openrouter
```

### 3. Publicar la configuración (opcional)

```bash
php artisan vendor:publish --tag=openrouter-config
```

## Configuración

Agrega las siguientes variables a tu archivo `.env`:

```
OPENROUTER_API_KEY=tu-clave-api
OPENROUTER_API_ENDPOINT=https://openrouter.ai/api/v1/
OPENROUTER_API_TIMEOUT=120
OPENROUTER_DEFAULT_MODEL=anthropic/claude-3.7-sonnet
```

## Uso básico

### Usando la Facade

```php
use Luinuxscl\OpenRouter\Facades\OpenRouter;

// Enviar un mensaje a OpenRouter
$messages = [
    ['role' => 'system', 'content' => 'Eres un asistente útil.'],
    ['role' => 'user', 'content' => '¿Cómo funciona la API de OpenRouter?']
];

$response = OpenRouter::chat($messages, 'anthropic/claude-3.7-sonnet');

// Obtener la lista de modelos disponibles
$models = OpenRouter::getModels();
```

### Usando inyección de dependencias

```php
use Luinuxscl\OpenRouter\Services\OpenRouterService;

class MiControlador
{
    protected $openRouter;
    
    public function __construct(OpenRouterService $openRouter)
    {
        $this->openRouter = $openRouter;
    }
    
    public function enviarMensaje(Request $request)
    {
        $response = $this->openRouter->chat(
            $request->input('messages'),
            $request->input('model', 'anthropic/claude-3.7-sonnet')
        );
        
        return response()->json($response);
    }
}
```

## Personalización

Puedes personalizar los parámetros adicionales al enviar mensajes al chat:

```php
$response = OpenRouter::chat(
    $messages,
    'anthropic/claude-3.7-sonnet',
    800, // max_tokens
    0.5, // temperature
    [
        'top_p' => 0.9,
        'stream' => false,
        // Otros parámetros...
    ]
);
```

## Soporte y Contribución

Para más información o soporte, puedes visitar [like.cl](https://like.cl) o contactar al autor a través de [GitHub](https://github.com/luinuxscl).

## Licencia

Este paquete está licenciado bajo la [Licencia MIT](LICENSE.md). 