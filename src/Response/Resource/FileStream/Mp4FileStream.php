<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\FileStream;

use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\File\FileExtension\VideoFileExtension;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\MimeType\VideoMimeType;
use Termyn\SmartReply\Response\Resource\FileStream;

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
