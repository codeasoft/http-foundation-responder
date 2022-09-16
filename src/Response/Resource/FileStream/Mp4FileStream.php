<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource\FileStream;

use Codea\SmartReply\File\FileExtension;
use Codea\SmartReply\File\FileExtension\VideoFileExtension;
use Codea\SmartReply\Http\MimeType;
use Codea\SmartReply\Http\MimeType\VideoMimeType;
use Codea\SmartReply\Response\Resource\FileStream;

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
