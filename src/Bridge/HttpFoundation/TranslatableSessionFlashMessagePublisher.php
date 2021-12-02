<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation;

use Symfony\Contracts\Translation\TranslatorInterface;
use Tuzex\Responder\Response\FlashMessage;
use Tuzex\Responder\Service\FlashMessagePublisher;

final class TranslatableSessionFlashMessagePublisher implements FlashMessagePublisher
{
    public function __construct(
        private FlashMessagePublisher $flashMessagePublisher,
        private TranslatorInterface $translator,
    ) {}

    public function publish(FlashMessage $flashMessage): void
    {
        $translatedFlashMessage = new FlashMessage(
            $flashMessage->type,
            $this->translator->trans($flashMessage->message),
        );

        $this->flashMessagePublisher->publish($translatedFlashMessage);
    }
}
