<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource\Template;

use Tuzex\Responder\File\FileExtension;
use Tuzex\Responder\File\FileExtension\TemplateFileExtension;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\TextMimeType;
use Tuzex\Responder\Response\Resource\Template;

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
