<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Bridge\Twig\TwigTemplateRenderer;
use Tuzex\Responder\Response\Definition\TwigTemplate;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Response\ResponseFactory;

final class TwigResponseFactory implements ResponseFactory
{
    public function __construct(
        private TwigTemplateRenderer $twigTemplateRenderer
    ) {}

    public function create(ResponseDefinition $responseDefinition, Closure $nextResponseFactory): Response
    {
        if (! $responseDefinition instanceof TwigTemplate) {
            return $nextResponseFactory($responseDefinition);
        }

        $httpConfig = $responseDefinition->httpConfig();

        return new Response($this->render($responseDefinition), $httpConfig->statusCode(), $httpConfig->headers());
    }

    private function render(TwigTemplate $responseDefinition): string
    {
        return $this->twigTemplateRenderer->render($responseDefinition->name(), $responseDefinition->parameters());
    }
}
