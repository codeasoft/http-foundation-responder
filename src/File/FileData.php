<?php

declare(strict_types=1);

namespace Tuzex\Responder\File;

abstract class FileData
{
    public function __construct(
        public readonly FileInfo $info,
        public readonly string $content
    ) {
    }
}
