<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource\FileStream;

use Codea\Responder\File\FileExtension;
use Codea\Responder\File\FileExtension\ArchiveFileExtension;
use Codea\Responder\Http\MimeType;
use Codea\Responder\Http\MimeType\ApplicationMimeType;
use Codea\Responder\Response\Resource\FileStream;

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
