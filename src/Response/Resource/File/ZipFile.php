<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\File;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\File\FileExtension\ArchiveFileExtension;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ApplicationMimeType;
use Tuzex\Responder\Response\Resource\File;

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
