<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;

final class RedirectToUrlTransformer implements ResultTransformer
{
    public function __construct(
        private RedirectResponseFactory $redirectResponseFactory,
    ) {}

    public function supports(Result $result): bool
    {
        return $result instanceof RedirectToUrl;
    }

    /**
     * @param RedirectToUrl $result
     */
    public function transform(Result $result): RedirectResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->redirectResponseFactory->create($result->getUrl(), $result->getHttpConfig());
    }
}
