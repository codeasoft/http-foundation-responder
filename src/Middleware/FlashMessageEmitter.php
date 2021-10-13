<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class FlashMessageEmitter implements Middleware
{
    public function __construct(
        private FlashMessagePublisher $flashMessagePublisher
    ) {}

    public function execute(Resource $resource, Closure $nextMiddleware): Response
    {
        $flashMessageBag = $resource->flashMessageBag();

        foreach ($flashMessageBag as $flashMessage) {
            $this->flashMessagePublisher->publish($flashMessage);
        }

        return $nextMiddleware($resource);
    }
}
