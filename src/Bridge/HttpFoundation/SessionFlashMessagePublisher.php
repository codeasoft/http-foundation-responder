<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Bridge\HttpFoundation;

use Termyn\SmartReply\Bridge\HttpFoundation\Request\RequestFlashBagProvider;
use Termyn\SmartReply\Response\FlashMessage;
use Termyn\SmartReply\Service\FlashMessagePublisher;

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
