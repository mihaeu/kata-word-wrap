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
        $sourceLength = strlen($source);
        if ($sourceLength <= $columns) {
            return $source;
        }

        $output = '';
        for ($i = 0; $i < $sourceLength; ++$i) {
            if (($i + 1) % $columns === 0) {            // reached last column
                if ($source[$i] === ' ') {              // and it's a space
                    $output .= PHP_EOL;
                } else {                                // or it's a normal character
                    $output .= $source[$i].PHP_EOL;
                }
            } else {                                    // normal character in line
                $output .= $source[$i];
            }
        }

        return $output;
    }
}
