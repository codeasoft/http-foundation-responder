<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Payload;

use Tuzex\Responder\File\FileFormat;
use Tuzex\Responder\File\Template\TwigFileFormat;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\TextMimeType;
use Tuzex\Responder\Response\Resource\Template;

final class TwigTemplate extends Template
{
    protected function fileFormat(): FileFormat
    {
        return new TwigFileFormat();
    }

    protected function mimeType(): MimeType
    {
        return TextMimeType::HTML;
    }
}
