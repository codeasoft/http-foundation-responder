<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

final class UrlRedirect extends Result
{
    private string $urlAddress;

    private function __construct(string $urlAddress, HttpConfig $httpConfig)
    {
        Assertion::url($urlAddress);

        $this->urlAddress = $urlAddress;

        parent::__construct($httpConfig);
    }

    public static function define(string $urlAddress, int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self($urlAddress, HttpConfig::set($statusCode));
    }

    public function urlAddress(): string
    {
        return $this->urlAddress;
    }
}
