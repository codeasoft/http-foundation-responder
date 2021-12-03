<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\FlashMessage;
use Tuzex\Responder\Response\FlashMessageBag;
use Tuzex\Responder\Response\Resource;

abstract class Redirect extends Resource
{
    private FlashMessageBag $flashMessageBag;

    public function __construct(
        StatusCode $statusCode = StatusCode::FOUND,
        HttpHeader ...$httpHeaders
    ) {
        $this->flashMessageBag = new FlashMessageBag();

        parent::__construct($statusCode, ...$httpHeaders);
    }

    public function flashMessageBag(): FlashMessageBag
    {
        return $this->flashMessageBag;
    }

    public function addFlashMessage(FlashMessage ...$messages): void
    {
        $this->flashMessageBag = $this->flashMessageBag->push(...$messages);
    }
}
