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

        $words = explode(' ', $source);
        foreach ($words as $word) {
            if (self::currentLineIsEmpty($lines[$currentLine])) {
                $lines[$currentLine] = $word;
            } else if (self::nextWordCanFitLine($lines[$currentLine], $word, $columns)) {
                $lines[++$currentLine] = $word;
            } else {
                $lines[$currentLine] .= ' '.$word;
            }
        }
        return implode(PHP_EOL, $lines);
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