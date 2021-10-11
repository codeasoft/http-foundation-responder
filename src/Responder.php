<?php

declare(strict_types=1);

namespace Tuzex\Responder;

use Symfony\Component\HttpFoundation\Response;
use Tuzex\Responder\Response\Resource;

interface Responder
{
    public function process(Resource $resource): Response;
}
