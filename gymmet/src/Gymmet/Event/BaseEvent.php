<?php

namespace Gymmet\Event;

class BaseEvent implements EventInterface
{
	use \Gymmet\DateTime\DateTimeTrait;
	
    protected $id;
    protected $start;
    protected $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setStart(\DateTime $date)
    {
        $this->start = $date;

        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setEnd(\DateTime $date)
    {
        $this->end = $date;

        return $this;
    }

    public function getEnd()
    {
    	return $this->end;
    }
}