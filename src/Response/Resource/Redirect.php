<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource;

use Termyn\SmartReply\Http\HttpHeader;
use Termyn\SmartReply\Http\StatusCode;
use Termyn\SmartReply\Response\FlashMessage;
use Termyn\SmartReply\Response\FlashMessageBag;
use Termyn\SmartReply\Response\Resource;

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
