<?php

namespace Gymmet\Collection;

use Gymmet\Event\EventInterface;

interface CollectionInterface
{
    public function add(EventInterface $item);

    public function getAll();
}