<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as UrlGenerator;
use Tuzex\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;

final class RedirectToRouteTransformer implements ResultTransformer
{
    public function __construct(
        private UrlGenerator $urlGenerator,
        private RedirectResponseFactory $redirectResponseFactory,
    ) {}

    public function supports(Result $result): bool
    {
        return $result instanceof RedirectToRoute;
    }

    /**
     * @param RedirectToRoute $result
     */
    public function transform(Result $result): RedirectResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        $url = $this->urlGenerator->generate($result->getName(), $result->getParameters());

        return $this->redirectResponseFactory->create($url, $result->getHttpConfig());
    }
}
