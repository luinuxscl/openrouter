<?php

namespace Luinuxscl\OpenRouter\Facades;

use Illuminate\Support\Facades\Facade;
use Luinuxscl\OpenRouter\Services\OpenRouterService;

/**
 * @method static array chat(array $messages, string $model, int $maxTokens = 500, float $temperature = 0.7, array $additionalParams = [])
 * @method static array getModels()
 * 
 * @see \Luinuxscl\OpenRouter\Services\OpenRouterService
 */
class OpenRouter extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return OpenRouterService::class;
    }
} 