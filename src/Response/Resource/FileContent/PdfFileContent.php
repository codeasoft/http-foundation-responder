<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\FileContent;

use Tuzex\Responder\File\Document\PdfFileFormat;
use Tuzex\Responder\File\FileFormat;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;
use Tuzex\Responder\Response\Resource\FileContent;

final class PdfFileContent extends FileContent
{
    protected function fileFormat(): FileFormat
    {
        return new PdfFileFormat();
    }

    protected function mimeType(): MimeType
    {
        return ApplicationMimeType::PDF;
    }
}
