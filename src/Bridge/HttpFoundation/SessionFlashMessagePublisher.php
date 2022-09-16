<?php

declare(strict_types=1);

namespace Codea\SmartReply\Bridge\HttpFoundation;

use Codea\SmartReply\Bridge\HttpFoundation\Request\RequestFlashBagProvider;
use Codea\SmartReply\Response\FlashMessage;
use Codea\SmartReply\Service\FlashMessagePublisher;

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
