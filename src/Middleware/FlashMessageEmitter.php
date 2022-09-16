<?php

declare(strict_types=1);

namespace Codea\SmartReply\Middleware;

use Closure;
use Codea\SmartReply\Middleware;
use Codea\SmartReply\Response\FlashMessageBag;
use Codea\SmartReply\Response\Resource;
use Codea\SmartReply\Response\Resource\Redirect;
use Codea\SmartReply\Service\FlashMessagePublisher;
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
