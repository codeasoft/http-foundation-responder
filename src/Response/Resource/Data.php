<?php

declare(strict_types=1);

namespace Codea\Responder\Response\Resource;

interface Data
{
    public function datalist(): iterable;
}
