<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\Archive;

use Tuzex\Responder\File\FileFormat;

final class ZipFileFormat extends FileFormat
{
    protected function suffix(): string
    {
        return 'zip';
    }
}
