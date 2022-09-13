<?php

declare(strict_types=1);

namespace Codea\Responder\Bridge\HttpFoundation;

use Codea\Responder\Response\FlashMessage;
use Codea\Responder\Service\FlashMessagePublisher;
use Symfony\Contracts\Translation\TranslatorInterface;

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
