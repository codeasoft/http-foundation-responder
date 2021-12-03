<?php

declare(strict_types=1);

namespace Tuzex\Responder\Response\Resource;

interface Data
{
    public function datalist(): iterable;
}
