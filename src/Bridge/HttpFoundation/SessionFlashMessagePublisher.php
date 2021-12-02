<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation;

use Tuzex\Responder\Bridge\HttpFoundation\Request\RequestFlashBagProvider;
use Tuzex\Responder\Response\FlashMessage;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class SessionFlashMessagePublisher implements FlashMessagePublisher
{
    public function __construct(
        private RequestFlashBagProvider $requestFlashBagProvider,
    ) {}

    public function publish(FlashMessage $flashMessage): void
    {
        $flashBag = $this->requestFlashBagProvider->provide();
        $flashBag->add($flashMessage->type, $flashMessage->message);
    }
}
