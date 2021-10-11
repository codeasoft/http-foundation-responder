<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Factory;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Bridge\Twig\TwigTemplateRenderer;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\TwigTemplate;
use Tuzex\Responder\Response\ResponseFactory;

final class TwigResponseFactory implements ResponseFactory
{
    public function __construct(
        private TwigTemplateRenderer $twigTemplateRenderer
    ) {}

    public function create(Resource $resource, Closure $nextResponseFactory): Response
    {
        if (! $resource instanceof TwigTemplate) {
            return $nextResponseFactory($resource);
        }

        $httpConfig = $resource->httpConfig();
        $plainContent = $this->render($resource);

        return new Response($plainContent, $httpConfig->statusCode(), $httpConfig->headers());
    }

    private function render(TwigTemplate $resource): string
    {
        return $this->twigTemplateRenderer->render($resource->path(), $resource->parameters());
    }
}
