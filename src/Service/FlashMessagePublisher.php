<?php

declare(strict_types=1);

namespace Codea\SmartReply\Service;

use Codea\SmartReply\Response\FlashMessage;

interface FlashMessagePublisher
{
    public function publish(FlashMessage $flashMessage): void;
}
