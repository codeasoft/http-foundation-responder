<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\Media;

use Tuzex\Responder\File\FileFormat;

final class JpgFileFormat extends FileFormat
{
    protected function suffix(): string
    {
        return 'jpg';
    }
}
