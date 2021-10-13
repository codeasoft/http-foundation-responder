<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Tuzex\Responder\Response\FlashMessage;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class SessionFlashMessagePublisher implements FlashMessagePublisher
{
    public function __construct(
        private FlashBagInterface $flashBag,
    ) {}

    public function publish(FlashMessage $flashMessage): void
    {
        $this->flashBag->add($flashMessage->type(), $flashMessage->message());
    }
}
