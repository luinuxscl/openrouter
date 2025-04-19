<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenRouter API Key
    |--------------------------------------------------------------------------
    |
    | Aquí puede especificar la clave API para acceder a la API de OpenRouter.
    | Esta clave es necesaria para autenticar sus solicitudes al servicio OpenRouter.
    | Puede obtener su clave API desde el panel de control de OpenRouter.
    |
    */
    'api_key' => env('OPENROUTER_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | OpenRouter API Endpoint
    |--------------------------------------------------------------------------
    |
    | Aquí puede especificar la URL del endpoint para la API de OpenRouter.
    | Esta es la URL donde su aplicación enviará solicitudes para interactuar con OpenRouter.
    | Puede encontrar la URL del endpoint de la API en la documentación de OpenRouter.
    | El valor predeterminado es https://openrouter.ai/api/v1/, que es la URL base para todas las solicitudes.
    */
    'api_endpoint' => env('OPENROUTER_API_ENDPOINT', 'https://openrouter.ai/api/v1/'),

    /*
    |--------------------------------------------------------------------------
    | OpenRouter Timeout
    |--------------------------------------------------------------------------
    |
    | Tiempo de espera de solicitud en segundos. Aumente el valor a 120 - 180 si usa modelos 
    | de largo procesamiento como openai/o1
    |
    */
    'api_timeout' => env('OPENROUTER_API_TIMEOUT', 120),

    /*
    |--------------------------------------------------------------------------
    | OpenRouter Title
    |--------------------------------------------------------------------------
    |
    | Título de su aplicación para pasar a OpenRouter
    |
    */
    'title' => env('OPENROUTER_API_TITLE', 'Starter App'),

    /*
    |--------------------------------------------------------------------------
    | OpenRouter Referer
    |--------------------------------------------------------------------------
    |
    | URL de su aplicación para pasar a OpenRouter
    |
    */
    'referer' => env('OPENROUTER_API_REFERER', env('APP_URL', 'https://starter.com')),

    /*
    |--------------------------------------------------------------------------
    | Modelos disponibles
    |--------------------------------------------------------------------------
    |
    | Lista de modelos disponibles en OpenRouter que desea utilizar
    |
    */
    'available_models' => [
        'deepseek/deepseek-chat-v3-0324' => 'DeepSeek Chat v3',
        'deepseek/deepseek-r1' => 'DeepSeek R1',
        'anthropic/claude-3.7-sonnet' => 'Claude 3.7 Sonnet',
        'openai/o3-mini' => 'o3-mini',
        'openai/chatgpt-4o-latest' => 'GPT-4o',
        // Añada más modelos según sea necesario
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Modelo predeterminado
    |--------------------------------------------------------------------------
    |
    | El modelo predeterminado a utilizar cuando no se especifica uno
    |
    */
    'default_model' => env('OPENROUTER_DEFAULT_MODEL', 'anthropic/claude-3.7-sonnet'),
]; 