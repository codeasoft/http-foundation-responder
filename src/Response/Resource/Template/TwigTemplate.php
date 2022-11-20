<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource\Template;

use Termyn\SmartReply\File\FileExtension;
use Termyn\SmartReply\File\FileExtension\TemplateFileExtension;
use Termyn\SmartReply\Http\MimeType;
use Termyn\SmartReply\Http\MimeType\TextMimeType;
use Termyn\SmartReply\Response\Resource\Template;

final class TwigTemplate extends Template
{
    protected function fileExtension(): FileExtension
    {
        return TemplateFileExtension::TWIG;
    }

    protected function mimeType(): MimeType
    {
        return TextMimeType::HTML;
    }
}
