<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource\Template;

use Codea\Responder\File\FileExtension;
use Codea\Responder\File\FileExtension\TemplateFileExtension;
use Codea\Responder\Http\MimeType;
use Codea\Responder\Http\MimeType\TextMimeType;
use Codea\Responder\Response\Resource\Template;

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
