<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Tuzex\Responder\Response\FlashMessage;
use Tuzex\Responder\Response\FlashMessageBag;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

abstract class Redirect extends Resource
{
    private FlashMessageBag $flashMessageBag;

    protected function __construct(HttpConfig $httpConfig)
    {
        parent::__construct($httpConfig);

        $this->flashMessageBag = new FlashMessageBag();
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
