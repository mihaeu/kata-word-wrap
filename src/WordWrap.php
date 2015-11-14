<?php declare(strict_types=1);

namespace Mihaeu\Kata;

class WordWrap
{
    /**
     * @param string $source
     * @param int $columns
     * @return string
     */
    public function wrap(\string $source, \int $columns) : \string
    {
        // this is not the fastest, but the most convenient way of dealing with
        // linebreaks from Windows or pre OS-X systems, output will always use system linebreaks
        $source = str_replace(["\r\n", "\r"], "\n", $source);

        // used to keep track of lines that already have newlines
        $overhead = 0;
        $output = '';
        for ($i = 0; $i < strlen($source); ++$i) {
            // reached last column
            if (($i + 1 + $overhead) % $columns === 0) {
                // and it's a space
                if ($source[$i] === ' ') {
                    $output .= PHP_EOL;
                // or it's a normal character
                } else {
                    $output .= $source[$i].PHP_EOL;
                }
            // normal character in line
            } else {
                $output .= $source[$i];
                // if there's a linefeed in the original text, we have to keep it
                if ($source[$i] === "\n") {
                    // keep track of the characters left in line
                    $overhead = $columns - ($i +1) % $columns;
                }
            }
        }

        return $output;
    }
}
