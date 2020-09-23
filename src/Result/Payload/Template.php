<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Payload;

use Assert\Assertion;
use Tuzex\Symfony\Responder\Result\HttpConfigs;
use Tuzex\Symfony\Responder\Result\Result;

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
