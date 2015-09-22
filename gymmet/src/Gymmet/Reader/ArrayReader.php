<?php

namespace Gymmet\Reader;

class ArrayReader extends BaseReader
{
    public function __construct($data = null){
        $this->data = $data;
    }

    public function getData()
    {
        return $this->parse();
    }

    public function isValid($data)
    {
        return is_array($data);
    }

    protected function parse()
    {
        $timeRows = $this->data;

        return $this->getTimeRowsAsDateTime($timeRows);
    }

}