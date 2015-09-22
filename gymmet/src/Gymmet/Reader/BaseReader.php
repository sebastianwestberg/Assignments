<?php

namespace Gymmet\Reader;

abstract class BaseReader implements ReaderInterface
{
    use \Gymmet\DateTime\DateTimeTrait;

    protected $data;

    abstract protected function parse();

    abstract public function isValid($data);

    protected function getTimeRowsAsDateTime($timeRows, $timeDelimiter = null)
    {
        foreach ($timeRows as $i => $timeRange) {
            if (empty($timeRange)) {
                unset($timeRows[$i]);
                continue;
            }

            // e.g. "10:30-12:00" becomes ['10:30', '12:00'] with the "-" delimiter
            $timeRangeArr = null !== $timeDelimiter ? explode($timeDelimiter, $timeRange) : $timeRange;

            foreach ($timeRangeArr as &$time) {
                $time = $this->getAsDateTime($time);
            }

            $timeRows[$i] = $timeRangeArr;
        }

        return $timeRows;
    }
}