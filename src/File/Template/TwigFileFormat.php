<?php

declare(strict_types=1);

namespace Tuzex\Responder\File\Template;

use Tuzex\Responder\File\FileFormat;

final class TwigFileFormat extends FileFormat
{
    protected function suffix(): string
    {
        return 'twig';
    }
}
