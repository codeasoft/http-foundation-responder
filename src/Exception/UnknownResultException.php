<?php

declare(strict_types=1);

namespace Tuzex\Symfony\Responder\Exception;

use RuntimeException;
use Tuzex\Symfony\Responder\Result\Result;

final class UnknownResultException extends RuntimeException
{
    public function __construct(Result $result)
    {
        /*
         * @todo refactor PHP 8 $result::class
         */
        parent::__construct(sprintf('Result "%s" not have any transformer.', get_class($result)));
    }
}
