<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result;

interface Metadata
{
    public function getType(): string;

    /**
     * @return mixed
     *
     * @todo PHP8 => :mixed
     */
    public function getValue();
}
