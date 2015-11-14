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
            if ($source[$i] === ' ' && ($i + 1) % $columns === 0) {
                $output .= PHP_EOL;
            } elseif (($i + 1) % $columns === 0) {
                $output .= $source[$i].PHP_EOL;
            } else {
                $output .= $source[$i];
            }
        }

        return $output;
    }
}
