<?php

declare(strict_types=1);

namespace Tuzex\Responder\Service;

use Tuzex\Responder\Response\FlashMessage;

interface FlashMessagePublisher
{
    public function publish(FlashMessage $flashMessage): void;
}
