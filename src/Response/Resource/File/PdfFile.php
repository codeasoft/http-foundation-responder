<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\File;

use Tuzex\Responder\File\Document\PdfFileFormat;
use Tuzex\Responder\File\FileFormat;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\Resource\File;

final class PdfFile extends File
{
    public function mimeType(): MimeType
    {
        return MimeType::PDF;
    }

    protected function fileFormat(): FileFormat
    {
        return new PdfFileFormat();
    }
}