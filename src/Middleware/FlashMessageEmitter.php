<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Termyn\SmartReply\Middleware;
use Termyn\SmartReply\Response\FlashMessageBag;
use Termyn\SmartReply\Response\Resource;
use Termyn\SmartReply\Response\Resource\Redirect;
use Termyn\SmartReply\Service\FlashMessagePublisher;

final class FlashMessageEmitter implements Middleware
{
    public function __construct(
        private FlashMessagePublisher $flashMessagePublisher
    ) {
    }

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
