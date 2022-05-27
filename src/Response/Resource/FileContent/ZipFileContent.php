<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\FileContent;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\File\FileExtension\ArchiveFileExtension;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;
use Tuzex\Responder\Response\Resource\FileContent;

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
