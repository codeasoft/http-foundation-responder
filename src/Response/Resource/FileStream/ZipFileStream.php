<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource\FileStream;

use Codea\SmartReply\File\FileExtension;
use Codea\SmartReply\File\FileExtension\ArchiveFileExtension;
use Codea\SmartReply\Http\MimeType;
use Codea\SmartReply\Http\MimeType\ApplicationMimeType;
use Codea\SmartReply\Response\Resource\FileStream;

final class ZipFileStream extends FileStream
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
