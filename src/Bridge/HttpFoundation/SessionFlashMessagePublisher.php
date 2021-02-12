<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class SessionFlashMessagePublisher implements FlashMessagePublisher
{
    public function __construct(
        private FlashBagInterface $flashBag,
    ) {}

    public function publish(string $type, string $message): void
    {
        $this->flashBag->add($type, $message);
    }
}
