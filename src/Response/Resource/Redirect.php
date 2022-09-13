<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource;

use Codea\Responder\Http\HttpHeader;
use Codea\Responder\Http\StatusCode;
use Codea\Responder\Response\FlashMessage;
use Codea\Responder\Response\FlashMessageBag;
use Codea\Responder\Response\Resource;

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
