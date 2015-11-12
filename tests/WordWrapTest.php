<?php declare(strict_types=1);

namespace Mihaeu\Kata;

class WordWrapTest extends \PHPUnit_Framework_TestCase
{
    /** @var WordWrap $wordWrap */
    private $wordWrap;
    
    public function setUp()
    {
        $this->wordWrap = new WordWrap();
    }

    public function testFitsOneLongWordInOneColumn()
    {
        $this->assertEquals('123456789', $this->wordWrap->wrap('123456789', 6));
    }

    public function testWrapsALineAfterTenColumns()
    {
        $this->assertEquals("test test\ntest", $this->wordWrap->wrap('test test test', 10));
    }

    public function testWrapsWhenPossibleOtherwiseBreaksBoundaties()
    {
        $this->assertEquals("testtesttesttest\ntest", $this->wordWrap->wrap('testtesttesttest test', 10));
        }

    public function testDoesNotRemoveExistingLinebreaks()
    {
        // poem by Hafiz-e Shirazi
        $source = <<<EOT
Rose petals let us scatter
And fill the cup with red wine
The firmaments let us shatter
And come with a new design
EOT;

        // break after x columns and leave linebreaks (this is ugly, but what an editor would do)
        $expected = <<<EOT
Rose petals let us
scatter
And fill the cup
with red wine
The firmaments let
us shatter
And come with a new
design
EOT;

        $this->assertEquals($expected, $this->wordWrap->wrap($source, 20));
    }
}