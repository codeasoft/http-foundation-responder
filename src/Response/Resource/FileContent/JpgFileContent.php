<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\FileContent;

use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\File\FileExtension\ImageFileExtension;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\MimeType\ImageMimeType;
use Termyn\SmartReply\Response\Resource\FileContent;

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
