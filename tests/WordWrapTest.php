<?php declare(strict_types=1);

namespace Mihaeu\Kata;

class WordWrapTest extends \PHPUnit_Framework_TestCase
{
    public function testFitsOneLongWordInOneColumn()
    {
        $this->assertEquals('123456789', WordWrap::wrap('123456789', 6));
    }

    public function testWrapsALineAfterTenColumns()
    {
        $this->assertEquals("test test\ntest", WordWrap::wrap('test test test', 10));
    }

    public function testWrapsWhenPossibleOtherwiseBreaksBoundaties()
    {
        $this->assertEquals("testtesttesttest\ntest", WordWrap::wrap('testtesttesttest test', 10));
    }
}