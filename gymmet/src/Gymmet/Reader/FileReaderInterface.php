<?php

namespace Gymmet\Reader;

interface FileReaderInterface
{
    public function getFile();

    public function readFile();

    public function hasFile();
}