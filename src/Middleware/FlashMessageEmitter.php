<?php

declare(strict_types=1);

namespace Tuzex\Responder\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Middleware;
use Tuzex\Responder\Response\FlashMessageBag;
use Tuzex\Responder\Response\Resource;
use Tuzex\Responder\Response\Resource\Redirect;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class FlashMessageEmitter implements Middleware
{
    public function __construct(
        private FlashMessagePublisher $flashMessagePublisher
    ) {}

    public function execute(Resource $resource, Closure $nextMiddleware): Response
    {
        if ($resource instanceof Redirect) {
            $this->publish($resource->flashMessageBag());
        }

        return $nextMiddleware($resource);
    }

    private function publish(FlashMessageBag $flashMessages): void
    {
        foreach ($flashMessages as $flashMessage) {
            $this->flashMessagePublisher->publish($flashMessage);
        }
    }
}
