<?php

declare(strict_types=1);

namespace Codea\Responder\Bridge\HttpFoundation;

use Codea\Responder\Bridge\HttpFoundation\Request\RequestFlashBagProvider;
use Codea\Responder\Response\FlashMessage;
use Codea\Responder\Service\FlashMessagePublisher;

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
