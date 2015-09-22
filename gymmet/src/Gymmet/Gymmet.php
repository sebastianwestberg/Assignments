<?php

namespace Gymmet;

use Gymmet\Event\WorkoutEvent;
use Gymmet\Collection\WorkoutEventCollection;

class Gymmet
{    
    use DateTime\DateTimeTrait;

    protected $reader;
    protected $collection;
    private $opening;
    private $closing;

    public function __construct(Reader\ReaderInterface $reader, Collection\CollectionInterface $collection, $options = array())
    {
        $this->reader = $reader;
        $this->collection = $collection;

        $defaults = ["opening" => "10:00", "closing" => "16:00"];

        $options = array_merge($defaults, $options);

        $this->opening = $this->getAsDateTime($options['opening']);
        $this->closing = $this->getAsDateTime($options['closing']);

        $this->update();
    }

    public function getReader()
    {
        return $this->reader;
    }

    public function update()
    {
        $events = $this->getReader()->getData();
        $collection = $this->getCollection();

        foreach ($events as $event) {
            $start = $event[0];
            $end = $event[1];
            $collection->add(new WorkoutEvent($start, $end));
        }

        return $collection;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function setOpening($opening)
    {
        $this->opening = $opening;
    }

    public function getOpening()
    {
        return $this->opening;
    }

    public function setClosing($closing)
    {
        if (false === $closing instanceof \DateTime) {
            $closing = $this->getAsDateTime($closing);
        }

        $this->closing = $closing;
    }

    public function getClosing()
    {
        return $this->closing;
    }

    private function addMinutes(\DateTimeImmutable $datetime, $duration = 0)
    {
        return $datetime->add(new \DateInterval('PT' . $duration . 'M'));
    }

    public function getTimeSuggestions($limit = 10, $duration = 60, $interval = 10, $order = 'ASC')
    {
        $suggestions = [];
        $collection = $this->getCollection();
        $events = $collection->getAll();

        $opens = $this->getOpening();

        // subtract user-specified duration from closing time so that
        // suggestions are given within the opening hours
        $closes = $this->getClosing()->sub(new \DateInterval('PT' . $duration . 'M'));

        // new immutable DateTime object to keep track of progress
        $pointerStart = \DateTimeImmutable::createFromMutable($opens);
        $pointerEnd = $pointerStart->add(new \DateInterval('PT' . $duration . 'M'));

        while ($pointerStart <= $closes) {
            $events = $collection->isActiveBetween($pointerStart, $pointerEnd);
            $eventsCount = count($events);
            $suggestions[] = ["start" => $pointerStart, "end" => $pointerEnd, "count" => $eventsCount];

            $pointerStart = $this->addMinutes($pointerStart, $interval);
            $pointerEnd = $this->addMinutes($pointerEnd, $interval);
        }

        usort($suggestions, function($a, $b) use($order) {
            return 'ASC' === $order ? $a['count'] - $b['count'] : $b['count'] - $a['count'];
        });

        return array_slice($suggestions, 0, $limit);
    }
}
