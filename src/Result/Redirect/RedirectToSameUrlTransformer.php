<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Redirect;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Tuzex\Symfony\Responder\Bridge\HttpFoundation\Response\RedirectResponseFactory;
use Tuzex\Symfony\Responder\Exception\UnsupportedResultException;
use Tuzex\Symfony\Responder\Result\Result;
use Tuzex\Symfony\Responder\Result\ResultTransformer;
use Tuzex\Symfony\Responder\Service\UriProvider;

final class RedirectToSameUrlTransformer implements ResultTransformer
{
    private UriProvider $uriProvider;
    private RedirectResponseFactory $redirectResponseFactory;

    public function __construct(UriProvider $uriProvider, RedirectResponseFactory $redirectResponseFactory)
    {
        $this->uriProvider = $uriProvider;
        $this->redirectResponseFactory = $redirectResponseFactory;
    }

    public function supports(Result $result): bool
    {
        return $result instanceof RedirectToSameUrl;
    }

    /**
     * @param RedirectToSameUrl $result
     */
    public function transform(Result $result): RedirectResponse
    {
        if (!$this->supports($result)) {
            throw new UnsupportedResultException($result, self::class);
        }

        return $this->redirectResponseFactory->create($this->uriProvider->provide(), $result->getHttpConfigs());
    }
}
