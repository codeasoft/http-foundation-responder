<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\FileContent;

use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\File\FileExtension\ArchiveFileExtension;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\MimeType\ApplicationMimeType;
use Termyn\SmartReply\Response\Resource\FileContent;

final class ZipFileContent extends FileContent
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
