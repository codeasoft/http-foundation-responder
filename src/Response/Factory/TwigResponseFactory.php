<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Bridge\Twig\TwigTemplateRenderer;
use Tuzex\Responder\Response\Resource\TwigTemplate;
use Tuzex\Responder\Response\ResponseFactory;
use Tuzex\Responder\Response\ResponseResource;

final class TwigResponseFactory implements ResponseFactory
{
    public function __construct(
        private TwigTemplateRenderer $twigTemplateRenderer
    ) {}

    public function create(ResponseResource $responseResource, Closure $nextResponseFactory): Response
    {
        if (! $responseResource instanceof TwigTemplate) {
            return $nextResponseFactory($responseResource);
        }

        $httpConfig = $responseResource->httpConfig();
        $plainContent = $this->render($responseResource);

        return new Response($plainContent, $httpConfig->statusCode(), $httpConfig->headers());
    }

    private function render(TwigTemplate $responseResource): string
    {
        return $this->twigTemplateRenderer->render($responseResource->path(), $responseResource->parameters());
    }
}
