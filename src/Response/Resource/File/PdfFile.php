<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\File;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\File\FileExtension\DocumentFileExtension;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;
use Tuzex\Responder\Response\Resource\File;

final class PdfFile extends File
{
    public function mimeType(): MimeType
    {
        return ApplicationMimeType::PDF;
    }

    protected function fileExtension(): FileExtension
    {
        return DocumentFileExtension::PDF;
    }
}
