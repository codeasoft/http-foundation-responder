<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class TranslatableSessionFlashMessagePublisher implements FlashMessagePublisher
{
    public function __construct(
        private FlashBagInterface $flashBag,
        private TranslatorInterface $translator,
    ) {}

    public function publish(string $type, string $message): void
    {
        $this->flashBag->add($message, $this->translator->trans($message));
    }
}
