<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Symfony\Component\HttpFoundation\Response;

interface Responder
{
    public function process(Result $result): Response;
}
