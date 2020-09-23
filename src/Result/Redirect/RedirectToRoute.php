<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Redirect;

use Assert\Assertion;
use Tuzex\Symfony\Responder\Http\StatusCode;
use Tuzex\Symfony\Responder\Result\HttpConfigs;
use Tuzex\Symfony\Responder\Result\Result;

final class RedirectToRoute extends Result
{
    private string $name;
    private array $parameters;

    public function __construct(string $name, array $parameters, HttpConfigs $httpConfigs)
    {
        Assertion::notEmpty($name);

        $this->name = $name;
        $this->parameters = $parameters;

        parent::__construct($httpConfigs);
    }

    public static function init(string $name, array $parameters = [], int $statusCode = StatusCode::OK): self
    {
        return new self($name, $parameters, HttpConfigs::set($statusCode));
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
