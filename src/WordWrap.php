<?php declare(strict_types=1);

namespace Mihaeu\Kata;

class WordWrap
{
    /** @var string[] $lines */
    private $lines = [];

    private $currentLine = 0;

    public function wrap(\string $source, \int $columns) : \string
    {
        $this->lines = [];
        $this->lines[$this->currentLine] = '';

        $words = $this->splitWords($source);
        foreach ($words as $word) {
            if (preg_match('/\s/', $word) === 1) {
                ++$this->currentLine;
                $this->lines[$this->currentLine] = '';
            }
            else if (strlen($this->lines[$this->currentLine]) === 0) {
                $this->lines[$this->currentLine] = $word;
            } else if ((strlen($this->lines[$this->currentLine]) + strlen(' '.$word)) > $columns) {
                $this->lines[++$this->currentLine] = $word;
            } else {
                $this->lines[$this->currentLine] .= ' '.$word;
            }
        }
        return implode(PHP_EOL, $this->lines);
    }

    private function splitWords(\string $source) : array
    {
        $wordsAndDelimiters = preg_split('/(\s)/', $source, -1, PREG_SPLIT_DELIM_CAPTURE);
        $words = array_filter($wordsAndDelimiters, function ($element) {
            if ($element != ' ') {
                return $element;
            }
        });
        return $words;
    }
}