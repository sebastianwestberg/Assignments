<?php

namespace spec\Gymmet\Event;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WorkoutEventSpec extends ObjectBehavior
{

    public function it_sets_an_identifier()
    {
        $this->setId('id')->getId()->shouldReturn('id');
    }

    public function it_sets_a_start_time()
    {
        $start = $this->getAsDateTime("10:00");
        $this->setStart($start)->getStart()->shouldBeAnInstanceOf('\DateTime');
    }

    public function it_sets_an_end_time()
    {
        $end = $this->getAsDateTime("10:00");
        $this->setEnd($end)->getEnd()->shouldBeAnInstanceOf('\DateTime');
    }

    public function it_converts_datetime_to_string()
    {
        $start = $this->getAsDateTime("10:00");

        $this->setStart($start)->getStart()->format('H:i')->shouldReturn('10:00');
    }
}