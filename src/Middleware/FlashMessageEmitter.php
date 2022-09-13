<?php

declare(strict_types=1);

namespace Codea\Responder\Middleware;

use Closure;
use Codea\Responder\Middleware;
use Codea\Responder\Response\FlashMessageBag;
use Codea\Responder\Response\Resource;
use Codea\Responder\Response\Resource\Redirect;
use Codea\Responder\Service\FlashMessagePublisher;
use Symfony\Component\HttpFoundation\Response;

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
