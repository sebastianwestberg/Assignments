<?php

namespace Gymmet\Collection;

use Gymmet\Event\EventInterface;

class WorkoutEventCollection extends Collection
{
    public function startsAndEndsBetween($start, $end)
    {
        $items = $this->getAll();
        $matches = [];

        foreach ($items as $event) {
        	if ($event->getStart() >= $start && $event->getEnd() <= $end) {
        		$matches[] = $event;
        	}
        }

        return $matches;
    }

    public function isActiveBetween($start, $end)
    {
        $items = $this->getAll();
        $matches = [];

        foreach ($items as $event) {
            $eventStart = $event->getStart();
            $eventEnd = $event->getEnd();

            if (($eventStart <= $start && $eventEnd >= $end)
                || ($eventStart >= $start && $eventEnd <= $end)
                || ($eventStart <= $start && $eventEnd >= $end)
                || ($eventStart <= $end && $eventEnd >= $end)
                || ($eventStart <= $start && ($eventEnd <= $end && $eventEnd >= $start))) {             
                
                $matches[] = $event;
            }
        }

        return $matches;
    }
}
