<?php

namespace spec\Gymmet\Collection;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Gymmet\Event\WorkoutEvent;

class WorkoutEventCollectionSpec extends ObjectBehavior
{
    use \Gymmet\DateTime\DateTimeTrait;

    function it_is_initializable()
    {
        $this->shouldHaveType('Gymmet\Collection\WorkoutEventCollection');
    }

    function it_adds_an_event(WorkoutEvent $event)
    {
        $this->add($event)->getAll()->shouldHaveCount(1);
    }

    function it_adds_multiple_events(WorkoutEvent $event1, WorkoutEvent $event2)
    {
        $this->add($event1->setId(1))->add($event2->setId(2));
        $this->getAll()->shouldHaveCount(2);
    }
}