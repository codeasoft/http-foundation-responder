<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Response\ResponseDefinition;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class PublishFlashMessagesMiddleware implements Middleware
{
    public function __construct(
        private FlashMessagePublisher $flashMessagePublisher
    ) {}

    public function execute(ResponseDefinition $responseDefinition, Closure $nextMiddleware): Response
    {
        foreach ($responseDefinition->flashMessageBag() as $flashMessage) {
            $this->flashMessagePublisher->publish($flashMessage->type(), $flashMessage->message());
        }

        return $nextMiddleware($responseDefinition);
    }
}
