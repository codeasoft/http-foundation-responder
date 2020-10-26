<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result;

use Symfony\Component\HttpFoundation\Response;

interface ResultTransformer
{
    public function supports(Result $result): bool;

    public function transform(Result $result): Response;
}
