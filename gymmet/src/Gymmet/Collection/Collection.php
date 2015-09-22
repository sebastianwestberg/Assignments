<?php

namespace Gymmet\Collection;

use Gymmet\Event\EventInterface;

class Collection implements CollectionInterface
{
    protected $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(EventInterface $item)
    {
        $this->items[] = $item;

        return $this;
    }

    public function getAll()
    {
        return $this->items;
    }
}
