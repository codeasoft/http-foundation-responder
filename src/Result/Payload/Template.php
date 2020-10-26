<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Assert\Assertion;
use Tuzex\Responder\Http\StatusCode;
use Tuzex\Responder\Result;

abstract class Template extends Result
{
    private string $name;
    private array $parameters;

    public function __construct(string $name, array $parameters, HttpConfigs $httpConfigs)
    {
        Assertion::endsWith($name, $this->getSuffix());

        $this->name = $name;
        $this->parameters = $parameters;

        parent::__construct($httpConfigs);
    }

    abstract public static function init(string $name, array $parameters = [], int $statusCode): self;

    public function getName(): string
    {
        return $this->name;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    abstract protected function getSuffix(): string;
}
