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

    public function testAcceptsEmptyString()
    {
        $this->assertEquals('', $this->wordWrap->wrap('', 99));
    }

    public function testFitsOneLongWordInOneColumn()
    {
        $this->assertEquals('123456'.PHP_EOL.'789', $this->wordWrap->wrap('123456789', 6));
    }

    public function testWrapsALineAfterTenColumns()
    {
        $this->assertEquals("1234 6789\n1234", $this->wordWrap->wrap('1234 6789 1234', 10));
    }

    public function testWrapsWhenPossibleOtherwiseBreaksBoundaties()
    {
        $this->assertEquals("testtestte'.PHP_EOL.'sttesttest", $this->wordWrap->wrap('testtesttesttest test', 10));
        }

    public function testDoesNotRemoveExistingLinebreaks()
    {
        $this->markTestSkipped();
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