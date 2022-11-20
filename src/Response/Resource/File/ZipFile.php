<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\File;

use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\File\FileExtension\ArchiveFileExtension;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\MimeType\ApplicationMimeType;
use Termyn\SmartReply\Response\Resource\File;

final class ZipFile extends File
{
    protected function fileExtension(): FileExtension
    {
        return ArchiveFileExtension::ZIP;
    }

    protected function mimeType(): MimeType
    {
        return ApplicationMimeType::ZIP;
    }
}
