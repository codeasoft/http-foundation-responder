<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Definition;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Response\HttpConfig;
use Tuzex\Responder\Response\ResponseDefinition;

final class UrlRedirect extends ResponseDefinition
{
    private string $url;

    private function __construct(string $url, HttpConfig $httpConfig)
    {
        Assertion::url($url);

        $this->url = $url;

        parent::__construct($httpConfig);
    }

    public static function define(string $url, int $statusCode = HttpStatusCode::FOUND): self
    {
        return new self($url, HttpConfig::set($statusCode));
    }

    public function url(): string
    {
        return $this->url;
    }
}
