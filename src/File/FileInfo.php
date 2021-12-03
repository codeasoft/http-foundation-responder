<?php

declare(strict_types=1);

namespace Tuzex\Responder\File;

use Assert\Assertion;
use Tuzex\Responder\Http\MimeType;

abstract class FileInfo
{
    public function __construct(
        public readonly string $path,
        public readonly string $name,
    ) {
        $extension = sprintf('.%s', ltrim($this->extension(), '.'));

        Assertion::endsWith($this->path, $extension);
        Assertion::endsWith($this->name, $extension);
    }

    abstract public function mime(): MimeType;

    abstract protected function extension(): string;
}
