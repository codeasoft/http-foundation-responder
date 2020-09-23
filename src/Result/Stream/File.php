<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Result\Stream;

use Assert\Assertion;
use Tuzex\Symfony\Responder\Result\HttpConfigs;
use Tuzex\Symfony\Responder\Result\Result;

abstract class File extends Result
{
    private string $path;
    private string $name;

    public function __construct(string $path, string $name, HttpConfigs $httpConfigs)
    {
        Assertion::endsWith($path, $this->getSuffix());
        Assertion::endsWith($name, $this->getSuffix());

        $this->path = $path;
        $this->name = $name;

        parent::__construct($httpConfigs);
    }

    abstract public static function initForDisplay(string $path, string $name, int $statusCode): self;

    abstract public static function initToDownload(string $path, string $name, int $statusCode): self;

    public function getPath(): string
    {
        return $this->path;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function getSuffix(): string;
}
