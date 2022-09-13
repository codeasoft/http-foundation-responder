<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource\FileContent;

use Codea\Responder\File\FileExtension;
use Codea\Responder\File\FileExtension\ArchiveFileExtension;
use Codea\Responder\Http\MimeType;
use Codea\Responder\Http\MimeType\ApplicationMimeType;
use Codea\Responder\Response\Resource\FileContent;

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
