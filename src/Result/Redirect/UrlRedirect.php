<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

final class UrlRedirect extends Result
{
    private string $url;

    private function __construct(string $url, HttpConfig $httpConfig)
    {
        Assertion::url($url);

        $this->url = $url;

        parent::__construct($httpConfig);
    }

    public static function order(string $url, int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self($url, HttpConfig::set($statusCode));
    }

    public function url(): string
    {
        return $this->url;
    }
}
