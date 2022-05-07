<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\File\Archive\ZipFileFormat;
use Tuzex\Responder\File\FileFormat;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Response\Resource\FileStream;

final class ZipFileStream extends FileStream
{
    protected function fileFormat(): FileFormat
    {
        return new ZipFileFormat();
    }

    protected function mimeType(): MimeType
    {
        return MimeType\ApplicationMimeType::ZIP;
    }
}
