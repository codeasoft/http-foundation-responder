<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Responder\Exception\UnsupportedResultException;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\ResultTransformer;
use Tuzex\Responder\Service\ReferrerProvider;

final class RedirectToReferrerTransformer implements ResultTransformer
{
    private ReferrerProvider $referrerProvider;
    private RedirectResponseFactory $redirectResponseFactory;

    public function __construct(ReferrerProvider $referrerProvider, RedirectResponseFactory $redirectResponseFactory)
    {
        $this->referrerProvider = $referrerProvider;
        $this->redirectResponseFactory = $redirectResponseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof RedirectToReferrer;
    }

    /**
     * @param RedirectToReferrer $result
     */
    public function transform(Result $result): RedirectResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->redirectResponseFactory->create($this->referrerProvider->provide(), $result->getHttpConfig());
    }
}
