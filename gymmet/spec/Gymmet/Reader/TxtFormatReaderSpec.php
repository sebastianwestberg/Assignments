<?php

namespace spec\Gymmet\Reader;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TxtFormatReaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Gymmet\Reader\TxtFormatReader');
    }

    function it_is_a_valid_file()
    {
        $this->shouldBeValid(__DIR__ . '/../example_files/3-ppl-with-2-overlapping.txt');
    }

    function it_is_an_invalid_file()
    {
        $this->shouldNotBeValid(__DIR__ . '/../example_files/3-ppl-with-2-overlapping.exe');
    }

    function it_sets_a_valid_file_through_setter()
    {
        $file = __DIR__ . '/../example_files/3-ppl-with-2-overlapping.txt';

        $this->setFile($file);
        $this->getFile()->shouldReturn($file);
        $this->shouldHaveFile();
    }

    function it_does_not_set_an_invalid_file_through_setter()
    {
        $this->setFile(__DIR__ . '/../example_files/3-ppl-with-2-overlapping.exe');
        $this->shouldNotHaveFile();
    }

    function it_sets_a_valid_file_through_constructor()
    {
        $this->beConstructedWith(__DIR__ . '/../example_files/3-ppl-with-2-overlapping.txt');
        $this->shouldHaveFile();
    }

    function it_does_not_set_an_invalid_file_through_constructor()
    {
        $this->beConstructedWith(__DIR__ . '/../example_files/3-ppl-with-2-overlapping.exe');
        $this->shouldNotHaveFile();
    }

    function it_does_not_read_files_that_are_not_set()
    {
        $this->shouldThrow(new \Exception('No file specified'))->during('readFile');
    }

    function it_reads_from_a_valid_file()
    {
        $file = __DIR__ . '/../example_files/3-ppl-with-2-overlapping.txt';
        $this->setFile($file);

        $this->readFile()->shouldBeString();
    }

    function it_parses_data_from_file()
    {
        $file = __DIR__ . '/../example_files/3-ppl-with-2-overlapping.txt';
        $this->setFile($file);

        $this->getData()->shouldHaveCount(3);
    }
}