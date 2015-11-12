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

        $words = self::splitWords($source);
        foreach ($words as $word) {
            if (self::wordIsLinefeed($word)) {
                ++$currentLine;
                $lines[$currentLine] = '';
            }
            else if (self::currentLineIsEmpty($lines[$currentLine])) {
                $lines[$currentLine] = $word;
            } else if (self::nextWordCanFitLine($lines[$currentLine], $word, $columns)) {
                $lines[++$currentLine] = $word;
            } else {
                $lines[$currentLine] .= ' '.$word;
            }
        }
        return implode(PHP_EOL, $lines);
    }

    private static function splitWords(\string $source) : array
    {
        $wordsAndDelimiters = preg_split('/(\s)/', $source, -1, PREG_SPLIT_DELIM_CAPTURE);
        return array_filter($wordsAndDelimiters, function ($element) {
            if ($element != ' ') {
                return $element;
            }
        });
    }

    private static function wordIsLineFeed(\string $word) : \bool
    {
        return preg_match('/\s/', $word) === 1;
    }

    private static function currentLineIsEmpty(\string $line) : \bool
    {
        return strlen($line) === 0;
    }

    private static function nextWordCanFitLine($line, $nextWord, $columns) : \bool
    {
        return (strlen($line) + strlen(' '.$nextWord)) > $columns;
    }
}