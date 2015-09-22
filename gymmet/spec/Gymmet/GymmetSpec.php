<?php

namespace spec\Gymmet;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Gymmet\Collection\WorkoutEventCollection;
use Gymmet\Reader\TxtFormatReader;
use Gymmet\Event\WorkoutEvent;

class GymmetSpec extends ObjectBehavior
{
    use \Gymmet\DateTime\DateTimeTrait;

    function let(TxtFormatReader $reader, WorkoutEventCollection $collection)
    {
        $reader->setFile(__DIR__ . '/../example_files/3-ppl-with-2-overlapping.txt');
        $this->beConstructedWith($reader, $collection);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Gymmet\Gymmet');
    }

    function it_sets_a_valid_reader()
    {
        $this->getReader()->shouldBeAnInstanceOf('\Gymmet\Reader\TxtFormatReader');
    }

    function it_sets_a_valid_collection()
    {
        $this->getCollection()->shouldBeAnInstanceOf('\Gymmet\Collection\WorkoutEventCollection');
    }

    function it_gets_all_events_between_a_time_range()
    {
        $start = $this->getAsDateTime("08:00");
        $end = $this->getAsDateTime("14:00");

        $this->getReader()->setFile("example_files/3-ppl-with-2-overlapping.txt");

        $this->update()->shouldReturnString();
    }
}