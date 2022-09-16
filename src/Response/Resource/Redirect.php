<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource;

use Codea\SmartReply\Http\HttpHeader;
use Codea\SmartReply\Http\StatusCode;
use Codea\SmartReply\Response\FlashMessage;
use Codea\SmartReply\Response\FlashMessageBag;
use Codea\SmartReply\Response\Resource;

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
