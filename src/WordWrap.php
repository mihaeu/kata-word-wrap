<?php declare(strict_types=1);

namespace Mihaeu\Kata;

class WordWrap
{
    public static function wrap(\string $source, \int $columns) : \string
    {
        /** @var string[] $lines */
        $lines = [];
        $currentLine = 0;
        $lines[$currentLine] = '';

        $wordsAndDelimiters = preg_split('/(\s)/', $source, -1, PREG_SPLIT_DELIM_CAPTURE);
        $words = array_filter($wordsAndDelimiters, function ($element) {
            if ($element != ' ') {
                return $element;
            }
        });
        foreach ($words as $word) {
            if (preg_match('/\s/', $word) === 1) {
                ++$currentLine;
                $lines[$currentLine] = '';
            }
            else if (strlen($lines[$currentLine]) === 0) {
                $lines[$currentLine] = $word;
            } else if ((strlen($lines[$currentLine]) + strlen(' '.$word)) > $columns) {
                $lines[++$currentLine] = $word;
            } else {
                $lines[$currentLine] .= ' '.$word;
            }
        }
        return implode(PHP_EOL, $lines);
    }
}