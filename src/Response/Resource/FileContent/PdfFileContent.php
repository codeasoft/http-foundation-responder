<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\FileContent;

use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\File\FileExtension\DocumentFileExtension;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\MimeType\ApplicationMimeType;
use Termyn\SmartReply\Response\Resource\FileContent;

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
