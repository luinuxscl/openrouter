<?php

namespace Luinuxscl\OpenRouter\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;

class OpenRouterService
{
    protected string $apiKey;
    protected string $apiEndpoint;
    protected int $timeout;
    protected array $headers;

    public function __construct()
    {
        $this->apiKey = config('openrouter.api_key', env('OPENROUTER_API_KEY'));
        $this->apiEndpoint = config('openrouter.api_endpoint', env('OPENROUTER_API_ENDPOINT', 'https://openrouter.ai/api/v1/'));
        $this->timeout = (int) config('openrouter.api_timeout', env('OPENROUTER_API_TIMEOUT', 120));
        $this->headers = [
            'HTTP-Referer' => config('openrouter.referer', config('app.url')),
            'X-Title' => config('openrouter.title', config('app.name')),
        ];
    }

    /**
     * Envía una solicitud de chat al API de OpenRouter
     *
     * @param array $messages Mensajes para el chat
     * @param string $model Modelo a utilizar
     * @param int $maxTokens Máximo número de tokens a generar
     * @param float $temperature Temperatura para la generación (0.0-1.0)
     * @param array $additionalParams Parámetros adicionales
     * @return array Respuesta del API
     * @throws \Exception
     */
    public function chat(array $messages, string $model, int $maxTokens = 500, float $temperature = 0.7, array $additionalParams = []): array
    {
        $requestData = array_merge([
            'messages' => $messages,
            'model' => $model,
            'max_tokens' => $maxTokens,
            'temperature' => $temperature,
        ], $additionalParams);

        try {
            $response = $this->makeRequest('chat/completions', $requestData);
            
            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Error en respuesta de OpenRouter', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                throw new \Exception("Error en la respuesta: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Error al comunicarse con OpenRouter', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
    
    /**
     * Obtiene modelos disponibles en OpenRouter
     *
     * @return array Lista de modelos disponibles
     * @throws \Exception
     */
    public function getModels(): array
    {
        try {
            $response = $this->makeRequest('models', [], 'GET');
            
            if ($response->successful()) {
                return $response->json();
            } else {
                throw new \Exception("Error al obtener modelos: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Error al obtener modelos de OpenRouter', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
    
    /**
     * Realiza una solicitud HTTP a OpenRouter
     *
     * @param string $endpoint Endpoint específico
     * @param array $data Datos para enviar
     * @param string $method Método HTTP (POST, GET)
     * @return Response Respuesta HTTP
     */
    protected function makeRequest(string $endpoint, array $data = [], string $method = 'POST'): Response
    {
        $url = rtrim($this->apiEndpoint, '/') . '/' . $endpoint;
        
        $request = Http::withToken($this->apiKey)
            ->timeout($this->timeout)
            ->withHeaders($this->headers);
            
        if ($method === 'POST') {
            return $request->post($url, $data);
        } else {
            return $request->get($url);
        }
    }
} 