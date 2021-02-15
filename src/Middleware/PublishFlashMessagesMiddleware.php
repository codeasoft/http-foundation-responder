<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Result;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class PublishFlashMessagesMiddleware implements Middleware
{
    public function __construct(
        private FlashMessagePublisher $flashMessagePublisher
    ) {}

    public function execute(Result $result, Closure $next): Response
    {
        foreach ($result->flashMessageBag() as $flashMessage) {
            $this->flashMessagePublisher->publish($flashMessage->type(), $flashMessage->message());
        }

        return $next($result);
    }
}
