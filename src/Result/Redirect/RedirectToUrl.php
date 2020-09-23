<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Redirect;

use Assert\Assertion;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;
use Tuzex\Symfony\Responder\Result\Result;

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
