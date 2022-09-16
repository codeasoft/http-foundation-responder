<?php

declare(strict_types=1);

namespace Codea\SmartReply\Bridge\HttpFoundation;

use Codea\SmartReply\Response\FlashMessage;
use Codea\SmartReply\Service\FlashMessagePublisher;
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
