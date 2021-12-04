<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\FileInfo;

use Tuzex\Responder\File\FileInfo;
use Tuzex\Responder\Http\MimeType;
use Tuzex\Responder\Http\MimeType\TextMimeType;

final class TwigFileInfo extends FileInfo
{
    public function __construct(string $path)
    {
        parent::__construct($path, substr(strrchr($path, "/"), 1));
    }

    public function mime(): MimeType
    {
        return TextMimeType::HTML;
    }

    protected function extension(): string
    {
        return 'html.twig';
    }
}
