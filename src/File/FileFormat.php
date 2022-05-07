<?php

declare(strict_types=1);

namespace Tuzex\Responder\File;

abstract class FileFormat
{
    public function extension(): string
    {
        return sprintf('.%s', ltrim($this->suffix(), '.'));
    }

    protected abstract function suffix(): string;
}
