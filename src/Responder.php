<?php

declare(strict_types=1);

namespace Codea\Responder;

use Codea\Responder\Response\Resource;
use Symfony\Component\HttpFoundation\Response;

interface Responder
{
    public function process(Resource $resource): Response;
}
