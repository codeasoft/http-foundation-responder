<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\Document;

use Tuzex\Responder\File\FileFormat;

final class PdfFileFormat extends FileFormat
{
    protected function suffix(): string
    {
        return 'pdf';
    }
}
