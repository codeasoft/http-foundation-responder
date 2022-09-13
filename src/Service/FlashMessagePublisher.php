<?php

declare(strict_types=1);

namespace Codea\Responder\Service;

use Codea\Responder\Response\FlashMessage;

interface FlashMessagePublisher
{
    public function publish(FlashMessage $flashMessage): void;
}
