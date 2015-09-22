<?php

namespace Gymmet\Reader;

class TxtFormatReader extends BaseReader implements FileReaderInterface
{
    const FILE_VALID_EXT = ".txt";

    protected $file;

    public function __construct($file = null)
    {
        if (null !== $file) {
            $this->setFile($file);
        }
    }

    protected function parse()
    {
        // remove all characters except for "0-9", ":", "-" and newlines
        $timeStr = preg_replace("/[^0-9:\-\n]/", "", $this->readFile());
        $timeRows = explode("\n", $timeStr);

        return $this->getTimeRowsAsDateTime($timeRows, '-');
    }

    public function readFile()
    {
        if (!$this->hasFile()) {
            throw new \Exception('No file specified');
        }

        $data = file_get_contents($this->file);
        $this->data = $data;

        return $data;
    }

    public function setFile($file = null)
    {
        if (!$this->isValid($file)) {
            return false;
        }

        $this->file = $file;
    }

    public function isValid($file)
    {
        return '.txt' === substr($file, '-4') && file_exists($file);
    }

    public function getFile()
    {
        return $this->file;
    }

    public function hasFile()
    {
        return null !== $this->file;
    }

    public function getData()
    {
        return $this->parse();
    }
}
