<?php

declare(strict_types=1);

namespace Tuzex\Responder\Exception;

use RuntimeException;
use Tuzex\Responder\Result;

final class UnsupportedResultException extends RuntimeException
{
    public function __construct(Result $result, string $factoryClass)
    {
        /*
         * @todo refactor PHP 8 $result::class
         */
        parent::__construct(
            sprintf('Result "%s" is not supported by the factory "%s".', get_class($result), $factoryClass)
        );
    }
}
