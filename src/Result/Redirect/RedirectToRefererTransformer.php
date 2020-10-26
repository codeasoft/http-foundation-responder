<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;
use Tuzex\Responder\Service\ReferrerProvider;

final class RedirectToRefererTransformer implements ResultTransformer
{
    private RefererProvider $refererProvider;
    private RedirectResponseFactory $redirectResponseFactory;

    public function __construct(RefererProvider $refererProvider, RedirectResponseFactory $redirectResponseFactory)
    {
        $this->refererProvider = $refererProvider;
        $this->redirectResponseFactory = $redirectResponseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof RedirectToReferer;
    }

    /**
     * @param RedirectToReferer $result
     */
    public function transform(Result $result): RedirectResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->redirectResponseFactory->create($this->refererProvider->provide(), $result->getHttpConfigs());
    }
}
