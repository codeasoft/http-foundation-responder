<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Bridge\HttpFoundation\Response\ResponseFactory;
use Tuzex\Responder\Bridge\Twig\TwigTemplateRenderer;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;

final class TwigTransformer implements ResultTransformer
{
    private TwigTemplateRenderer $twigTemplateRenderer;
    private ResponseFactory $responseFactory;

    public function __construct(TwigTemplateRenderer $twigTemplateRenderer, ResponseFactory $responseFactory)
    {
        $this->twigTemplateRenderer = $twigTemplateRenderer;
        $this->responseFactory = $responseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof Twig;
    }

    /**
     * @param Twig $result
     */
    public function transform(Result $result): Response
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->responseFactory->create(
            $this->twigTemplateRenderer->render($result->getName(), $result->getParameters()),
            $result->getHttpConfig()
        );
    }
}
