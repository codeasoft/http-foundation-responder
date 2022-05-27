<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\FileContent;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\File\FileExtension\ImageFileExtension;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\ImageMimeType;
use Tuzex\Responder\Response\Resource\FileContent;

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
