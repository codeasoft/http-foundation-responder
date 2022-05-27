<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\FileContent;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\File\FileExtension\DocumentFileExtension;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;
use Tuzex\Responder\Response\Resource\FileContent;

final class PdfFileContent extends FileContent
{
    protected function fileExtension(): FileExtension
    {
        return DocumentFileExtension::PDF;
    }

    protected function mimeType(): MimeType
    {
        return ApplicationMimeType::PDF;
    }
}
