<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Assert\Assertion;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

final class RedirectToUrl extends Result
{
    private string $url;

    public function __construct(string $url, HttpConfigs $httpConfigs)
    {
        Assertion::url($url);

        $this->url = $url;

        parent::__construct($httpConfigs);
    }

    public static function init(string $url, int $statusCode = StatusCode::OK): self
    {
        return new self($url, HttpConfigs::set($statusCode));
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
