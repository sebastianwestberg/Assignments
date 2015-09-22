<?php

namespace Gymmet\Event;

interface EventInterface
{
	public function getId();

	public function setStart(\DateTime $date);

	public function getStart();

	public function setEnd(\DateTime $date);

	public function getEnd();

	public function setId($id);
}