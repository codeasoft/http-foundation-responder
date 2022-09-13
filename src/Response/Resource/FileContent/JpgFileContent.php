<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource\FileContent;

use Codea\Responder\File\FileExtension;
use Codea\Responder\File\FileExtension\ImageFileExtension;
use Codea\Responder\Http\MimeType;
use Codea\Responder\Http\MimeType\ImageMimeType;
use Codea\Responder\Response\Resource\FileContent;

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
