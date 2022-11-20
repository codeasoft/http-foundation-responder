<?php

declare(strict_types=1);

namespace Termyn\SmartReply\Response\Resource;

interface Data
{
    public function datalist(): iterable;
}
