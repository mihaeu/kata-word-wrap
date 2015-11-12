<?php

namespace Mihaeu\Kata;

class WordWrapTest extends \PHPUnit_Framework_TestCase
{
    public function testWrap()
    {
        $this->assertEquals('test', WordWrap::wrap('test', 10));
    }
}