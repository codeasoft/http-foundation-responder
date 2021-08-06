<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response;

use Tuzex\Responder\Http\HttpHeader;
use Tuzex\Responder\Http\HttpHeaders;

abstract class ResponseDefinition
{
    private HttpConfig $httpConfig;
    private FlashMessageBag $flashMessageBag;

    protected function __construct(HttpConfig $httpConfig)
    {
        $this->httpConfig = $httpConfig;
        $this->flashMessageBag = new FlashMessageBag();
    }

    public function httpConfig(): HttpConfig
    {
        return $this->httpConfig;
    }

    public function flashMessageBag(): FlashMessageBag
    {
        return $this->flashMessageBag;
    }

    public function addHttpHeader(HttpHeader ...$headers): void
    {
        $this->httpConfig = $this->httpConfig->setHeaders(new HttpHeaders(...$headers));
    }

    public function addFlashMessage(FlashMessage ...$messages): void
    {
        $this->flashMessageBag = $this->flashMessageBag->push(...$messages);
    }
}
