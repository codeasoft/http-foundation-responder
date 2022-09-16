<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource\File;

use Codea\SmartReply\File\FileExtension;
use Codea\SmartReply\File\FileExtension\DocumentFileExtension;
use Codea\SmartReply\Http\MimeType;
use Codea\SmartReply\Http\MimeType\ApplicationMimeType;
use Codea\SmartReply\Response\Resource\File;

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
