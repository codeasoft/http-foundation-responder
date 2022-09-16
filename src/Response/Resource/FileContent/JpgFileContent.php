<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource\FileContent;

use Codea\SmartReply\File\FileExtension;
use Codea\SmartReply\File\FileExtension\ImageFileExtension;
use Codea\SmartReply\Http\MimeType;
use Codea\SmartReply\Http\MimeType\ImageMimeType;
use Codea\SmartReply\Response\Resource\FileContent;

final class JpgFileContent extends FileContent
{
    protected function fileExtension(): FileExtension
    {
        return ImageFileExtension::JPG;
    }

    protected function mimeType(): MimeType
    {
        return ImageMimeType::JPG;
    }
}
