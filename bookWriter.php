<?php

namespace book;

/**
 * Generates a randome book
 */
class BookWriter
{

    /**
     * Constructor (basically does nothing right now)
     */
    function __construct()
    {

    }

    /**
     * Writes the book
     *
     * @param string $outputType set type of output - html or standard output
     * 
     * @return void
     */
    function writeBook($outputType)
    {
        //$booklist = file_get_contents('books-crime.txt');
        $booklist = file(__DIR__ . '/books-crime.txt', FILE_IGNORE_NEW_LINES);
        //$books = explode("\n", $booklist);
        $books = $booklist;
        $sections = rand(6, 16);
        $paras = rand(7, 28);
        $counter = 0;
        $counter2 = 0;
        while ($counter < $sections) {
            while ($counter2 < $paras) {
                $this->pageMaker($outputType, $books[rand(0, (count($books) - 1))]);
                $counter2++;
            }

            $counter++;
            $counter2 = 0;
        }
    }

    /**
     * Generates each section of the book
     *
     * @param string $outputType specifies if this is for standard output (for text files, etc.) or html
     * @param array  $theBook    the randomly selected book from the book list to get info from
     * 
     * @return void
     */
    public function pageMaker($outputType, $theBook)
    {
        $contents = '';
        if ($outputType == 'html') {
            $contents = "<p>";
        }
        $bookdir = 'books2/' . trim($theBook);
        $book = file_get_contents(trim(strval($bookdir)));
        $objects = preg_split('/(?<=[.?!])\s+/', $book, -1, PREG_SPLIT_NO_EMPTY);
        $commonWords = ['a', 'and', 'the', 'if', 'but', 'else'];
        $longword = $commonWords[rand(0, (count($commonWords) - 1))];
        $object = count($objects) - 1;
        if ($object > 0) {
            $formatString = trim(strval($objects[rand(0, $object)]));

            $contents .= $this->FormatPunctuation($formatString);

            $pickaword = rand(0, 2);
            if ($pickaword == 0) {
                $longword = array_reduce(str_word_count($formatString, 1), function ($v, $p) {
                    return strlen($v) > strlen($p) ? $v : $p;
                }, 0);
            } else {
                $getWords = explode(' ', $formatString);
                if ((count($getWords) - 1) > 0) {
                    $longword = $getWords[rand(0, (count($getWords) - 1))];
                }
            }
            $lineCounter = 0;
            $graph = rand(2, 10);
            foreach ($objects as $arr) {
                $line = $this->contains(strval($longword), explode(' ', $arr));
                if ($line == true) {

                    $contents .= $this->formatPunctuation($arr);
                    $contents .= "  ";

                    if ($lineCounter == $graph) {

                        if ($outputType == 'html') {
                            $contents .= "</p><p>";
                        } else {
                            $contents .= "\n\r\n\r";
                        }
                        $lineCounter = 0;
                        $graph = rand(2, 10);
                    }
                    $lineCounter++;
                }
            }
            if ($outputType == 'html') {
                $contents .= "/<p>";
            } else {
                $contents .= "\n\r\n\r";
            }
            echo ($contents);
        }
    }

    /**
     * Adjusts punctation and such found in the book files
     *
     * Reduce duplicate punctuation such as !! to !
     * Reduce multiple spaces to single spaces
     * Remove any spaces before ? . ,
     * Add spaces after ; :
     * Add spaces after commas but not when they are part of a number
     * Add spaces after periods but not when they are part of a number or abbreviation
     * Remove whitespace from beginning and end of string
     * Removes any new lines from string
     * Capitalize first word of sentences
     * Change last character to a period if it is a comma
     * 
     * @param string $formatString the string to be formatted
     * 
     * @return void
     */
    public function formatPunctuation($formatString)
    {
        $punctuation = ';:';
        $spaced_punc = array(' ?', ' .', ' ,');
        $un_spaced_punc = array('?', '.', ',');
        $formatString = trim(preg_replace('/\s+/', ' ', $formatString));
        $formatString = str_replace($spaced_punc, $un_spaced_punc, $formatString);
        $formatString = preg_replace('/\[.*\]/', '', $formatString);
        $formatString = str_replace('_', '', $formatString);
        $formatString = str_replace(' i ', ' I ', $formatString);
        $formatString = str_replace(' i,', ' I,', $formatString);
        $formatString = str_replace(' i.', ' I.', $formatString);
        $formatString = str_replace(' i!', ' I!', $formatString);
        return $formatString;
    }

    /**
     * Returns true/false if selection contains required pattern
     *
     * @param string $str the pattern
     * @param array  $arr the bits to search
     * 
     * @return void
     */
    public function contains($str, array $arr)
    {
        foreach ($arr as $a) {
            if (stripos($a, $str) !== false) {
                return true;
            }
        }
        return false;
    }

}