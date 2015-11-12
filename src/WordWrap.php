<?php declare(strict_types=1);

namespace Mihaeu\Kata;

class WordWrap
{
    const WHITESPACE_REGEX = '/(\s)/';
    
    /** @var string[] $lines */
    private $lines = [];

    private $currentLine = 0;

    public function wrap(\string $source, \int $columns) : \string
    {
        $this->lines = [];
        $this->lines[$this->currentLine] = '';

        $words = $this->splitWords($source);
        foreach ($words as $word) {
            if ($this->wordIsLinefeed($word)) {
                $this->lines[++$this->currentLine] = '';
            } else if ($this->currentLineIsEmpty()) {
                $this->lines[$this->currentLine] = $word;
            } else if ($this->currentWordDoesNotFit($columns, $word)) {
                $this->lines[++$this->currentLine] = $word;
            } else {
                $this->lines[$this->currentLine] .= ' '.$word;
            }
        }
        return implode(PHP_EOL, $this->lines);
    }

    private function splitWords(\string $source) : array
    {
        $wordsAndDelimiters = preg_split(self::WHITESPACE_REGEX, $source, -1, PREG_SPLIT_DELIM_CAPTURE);
        $words = array_filter($wordsAndDelimiters, function ($element) {
            if ($element != ' ') {
                return $element;
            }
        });
        return $words;
    }

    private function wordIsLinefeed($word)
    {
        return preg_match(self::WHITESPACE_REGEX, $word) === 1;
    }

    private function currentLineIsEmpty()
    {
        return strlen($this->lines[$this->currentLine]) === 0;
    }

    private function currentWordDoesNotFit(\int $columns, $word)
    {
        return (strlen($this->lines[$this->currentLine]) + strlen(' ' . $word)) > $columns;
    }
}
