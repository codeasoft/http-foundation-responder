<?php

declare(strict_types=1);

namespace Codea\SmartReply\Response\Resource\Template;

use Codea\SmartReply\File\FileExtension;
use Codea\SmartReply\File\FileExtension\TemplateFileExtension;
use Codea\SmartReply\Http\MimeType;
use Codea\SmartReply\Http\MimeType\TextMimeType;
use Codea\SmartReply\Response\Resource\Template;

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
