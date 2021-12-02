<?php

declare(strict_types=1);

namespace Tuzex\Responder\File;

interface FileType
{
    public function extension(): string;
}
