<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\FileStream;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\File\FileExtension\VideoFileExtension;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\VideoMimeType;
use Tuzex\Responder\Response\Resource\FileStream;

final class Mp4FileStream extends FileStream
{
    protected function fileExtension(): FileExtension
    {
        return VideoFileExtension::MP4;
    }

    protected function mimeType(): MimeType
    {
        return VideoMimeType::MP4;
    }
}
