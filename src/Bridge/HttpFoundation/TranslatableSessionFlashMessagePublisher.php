<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Bridge\HttpFoundation;

use Symfony\Contracts\Translation\TranslatorInterface;
use Termyn\SmartReply\Response\FlashMessage;
use Termyn\SmartReply\Service\FlashMessagePublisher;

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
