<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Payload;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Symfony\Responder\Bridge\Symfony\Response\ResponseFactory;
use Tuzex\Symfony\Responder\Bridge\Twig\TwigTemplateRenderer;
use Tuzex\Symfony\Responder\Exception\UnsupportedResultException;
use Tuzex\Symfony\Responder\Result\Result;
use Tuzex\Symfony\Responder\Result\ResultTransformer;

final class TwigPayloadTransformer implements ResultTransformer
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
        return $result instanceof TwigTemplate;
    }

    /**
     * @param TwigTemplate $result
     */
    public function transform(Result $result): Response
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->responseFactory->create(
            $this->twigTemplateRenderer->render($result->getName(), $result->getParameters()),
            $result->getHttpConfigs()
        );
    }
}
