<?php

declare(strict_types=1);

namespace Tuzex\Responder\Bridge\HttpFoundation\Request;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

final class RequestFlashBagProvider
{
    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    public function provide(): FlashBagInterface
    {
        $session = $this->requestStack->getSession();

        $sessionBag = $session->getBag('flashes');
        if (! $sessionBag instanceof FlashBagInterface) {
            throw new InvalidArgumentException('Flash bag does not exist');
        }

        return $sessionBag;
    }
}
