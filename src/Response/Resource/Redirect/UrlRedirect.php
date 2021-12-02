<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Redirect;

use Assert\Assertion;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource\Redirect;

final class UrlRedirect extends Redirect
{
    public readonly string $url;

    private function __construct(string $url, HttpConfig $httpConfig)
    {
        Assertion::url($url);

        $this->url = $url;

        parent::__construct($httpConfig);
    }

    public static function set(string $url, StatusCode $statusCode = StatusCode::FOUND): self
    {
        return new self($url, HttpConfig::set($statusCode));
    }
}
