<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Bridge\Twig\TwigTemplateRenderer;
use Tuzex\Responder\ResponseFactory;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\Payload\TwigTemplate;

final class TwigResponseFactory implements ResponseFactory
{
    public function __construct(
        private TwigTemplateRenderer $twigTemplateRenderer
    ) {}

    public function create(Result $result, Closure $next): Response
    {
        if (! $result instanceof TwigTemplate) {
            return $next($result);
        }

        $httpConfig = $result->httpConfig();

        return new Response($this->render($result), $httpConfig->statusCode(), $httpConfig->headers());
    }

    private function render(TwigTemplate $result): string
    {
        return $this->twigTemplateRenderer->render($result->name(), $result->parameters());
    }
}
