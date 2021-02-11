<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result\Payload;

use Assert\Assertion;
use Tuzex\Responder\Http\HttpStatusCode;
use Tuzex\Responder\Result;
use Tuzex\Responder\Result\HttpConfig;

abstract class Template extends Result
{
    private string $templateName;
    private array $templateParameters;

    protected function __construct(string $templateName, array $templateParameters, HttpConfig $httpConfig)
    {
        Assertion::endsWith($templateName, sprintf('.%s', $this->templateType()));

        $this->templateName = $templateName;
        $this->templateParameters = $templateParameters;

        parent::__construct($httpConfig);
    }

    abstract public static function define(string $templateName, array $templateParameters = [], int $statusCode = HttpStatusCode::OK): self;

    public function templateName(): string
    {
        return $this->templateName;
    }

    public function templateParameters(): array
    {
        return $this->templateParameters;
    }

    abstract protected function templateType(): string;
}
