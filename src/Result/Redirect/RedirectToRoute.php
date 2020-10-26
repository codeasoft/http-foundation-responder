<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Redirect;

use Assert\Assertion;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

final class RedirectToRoute extends Result
{
    private string $name;
    private array $parameters;

    public function __construct(string $name, array $parameters, HttpConfig $httpConfig)
    {
        Assertion::notEmpty($name);

        $this->name = $name;
        $this->parameters = $parameters;

        parent::__construct($httpConfig);
    }

    public static function order(string $name, array $parameters = [], int $statusCode = StatusCode::OK): self
    {
        return new self($name, $parameters, HttpConfig::set($statusCode));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
