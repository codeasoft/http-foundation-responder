<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource\FileStream;

use Codea\Responder\File\FileExtension;
use Codea\Responder\File\FileExtension\VideoFileExtension;
use Codea\Responder\Http\MimeType;
use Codea\Responder\Http\MimeType\VideoMimeType;
use Codea\Responder\Response\Resource\FileStream;

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
