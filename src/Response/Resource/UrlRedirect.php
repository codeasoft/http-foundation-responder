<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\Resource;

final class UrlRedirect extends Resource
{
    private string $url;

    private function __construct(string $url, HttpConfig $httpConfig)
    {
        Assertion::url($url);

        $this->url = $url;

        parent::__construct($httpConfig);
    }

    public static function set(string $url, int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self($url, HttpConfig::set($statusCode));
    }

    public function url(): string
    {
        return $this->url;
    }
}
