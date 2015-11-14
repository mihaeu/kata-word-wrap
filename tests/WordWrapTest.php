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

    public function testShortWordsFits()
    {
        $this->assertEquals('test', $this->wordWrap->wrap('test', 10));
    }

    public function testFitsOneLongWordInOneColumn()
    {
        $this->assertEquals('123456'.PHP_EOL.'789', $this->wordWrap->wrap('123456789', 6));
    }

    public function testWrapsALineAfterTenColumns()
    {
        $this->assertEquals("1234 6789\n1234", $this->wordWrap->wrap('1234 6789 1234', 10));
    }

    public function testWrapsWhenPossibleOtherwiseBreaksBoundaries()
    {
        $this->assertEquals(
            'testtestte'.PHP_EOL.'sttest tes'.PHP_EOL.'t',
            $this->wordWrap->wrap('testtesttesttest test', 10)
        );
    }

    public function testDoesNotRemoveExistingLineBreaks()
    {
//        $this->markTestSkipped('Newline behaviour not specified.');

        // poem by Hafiz-e Shirazi
        $source = <<<EOT
Rose petals let us scatter
And fill the cup with red wine
The firmaments let us shatter
And come with a new design
EOT;
        // break after x columns and leave linebreaks (this is ugly, but what an editor would do)
        $expected = <<<EOT
Rose petals let us s
catter
And fill the cup wit
h red wine
The firmaments let u
s shatter
And come with a new
design
EOT;

        $this->assertEquals($expected, $this->wordWrap->wrap($source, 20));
    }

    public function testDoesNotRemoveExistingWindowsLineBreaks()
    {
        $source = "Rose petals let us scatter\r\n".
            "And fill the cup with red wine\r\n".
            "The firmaments let us shatter\r\n".
            "And come with a new design";

        // break after x columns and leave linebreaks (this is ugly, but what an editor would do)
        $expected = <<<EOT
Rose petals let us s
catter
And fill the cup wit
h red wine
The firmaments let u
s shatter
And come with a new
design
EOT;

        $this->assertEquals($expected, $this->wordWrap->wrap($source, 20));
    }

    public function testDoesNotRemoveExistingPreOsxLineBreaks()
    {
        $source = "Rose petals let us scatter\r".
            "And fill the cup with red wine\r".
            "The firmaments let us shatter\r".
            "And come with a new design";

        // break after x columns and leave linebreaks (this is ugly, but what an editor would do)
        $expected = <<<EOT
Rose petals let us s
catter
And fill the cup wit
h red wine
The firmaments let u
s shatter
And come with a new
design
EOT;

        $this->assertEquals($expected, $this->wordWrap->wrap($source, 20));
    }
}
