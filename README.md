# Word Wrap Kata by Rober Martin

My attempt at the kata which was suggested by Robert Martin on his blog. I used the following [description](http://codingdojo.org/cgi-bin/index.pl?KataWordWrap):

  > You write a class called Wrapper, that has a single static function named wrap that takes two arguments, a string, and a column number. The function returns the string, but with line breaks inserted at just the right places to make sure that no line is longer than the column number. You try to break lines at word boundaries.

  > Like a word processor, break the line by replacing the last space in a line with a newline.

## Getting started

 ```bash
# get the code
git clone https://github.com/mihaeu/kata-word-wrap
cd kata-word-wrap

# install dependencies using composer (if installed globally)
composer install

# run tests
vendor/bin/phpunit

# run tests on other solution
git checkout object-oriented
vendor/bin/phpunit
```

## Why?

With solution one I tried to do everything as required, with solution two (`git checkout object-oriented`) I went for a more object oriented design. In my opinion coding katas should not only be about hacking, but about learning and repeating the proper ways of working with a language.