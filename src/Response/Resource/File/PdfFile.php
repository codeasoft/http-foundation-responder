<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\File;

use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\File\FileExtension\DocumentFileExtension;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\MimeType\ApplicationMimeType;
use Termyn\SmartReply\Response\Resource\File;

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
