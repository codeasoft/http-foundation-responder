<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Service;

use Termyn\SmartReply\Response\FlashMessage;

interface FlashMessagePublisher
{
    public function publish(FlashMessage $flashMessage): void;
}
