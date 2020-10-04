<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Redirect;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Symfony\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Symfony\Responder\Exception\UnsupportedResultException;
use Tuzex\Symfony\Responder\Result\Result;
use Tuzex\Symfony\Responder\Result\ResultTransformer;

final class RedirectToUrlTransformer implements ResultTransformer
{
    private RedirectResponseFactory $redirectResponseFactory;

    public function __construct(RedirectResponseFactory $redirectResponseFactory)
    {
        $this->redirectResponseFactory = $redirectResponseFactory;
    }

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

        return $this->redirectResponseFactory->create($result->getUrl(), $result->getHttpConfigs());
    }
}
