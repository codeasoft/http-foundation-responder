<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource\File;

use Codea\Responder\File\FileExtension;
use Codea\Responder\File\FileExtension\DocumentFileExtension;
use Codea\Responder\Http\MimeType;
use Codea\Responder\Http\MimeType\ApplicationMimeType;
use Codea\Responder\Response\Resource\File;

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
