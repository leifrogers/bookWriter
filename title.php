<?php

namespace book;

/**
 * Class for creating title
 */
class Title
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $adjectives;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $nouns;

    /**
     * Starter phrases for the title
     *
     * @var array
     */
    protected $starters = ['The', 'The Case of The', 'The Return of The'];

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->adjectives = file(__DIR__ . '/adj.txt', FILE_IGNORE_NEW_LINES);
        $this->nouns = file(__DIR__ . '/nouns.txt', FILE_IGNORE_NEW_LINES);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getTitle()
    {
        $adjective = $this->getRandomWord($this->adjectives);
        $noun = $this->getRandomWord($this->nouns, $adjective[0]);
        $starter = $this->starters[array_rand($this->starters)];
        return ucwords("{$starter} {$adjective} {$noun}");
    }

    /**
     * Gets random word from an array of words with optional alliteration potential
     *
     * @param array  $words          array of words to choose from
     * @param [type] $startingLetter the potential starting letter for alliteration
     * 
     * @return void
     */
    protected function getRandomWord(array $words, $startingLetter = null)
    {
        $wordsToSearch = $startingLetter === null ? $words : preg_grep("/^{$startingLetter}/", $words);
        return $wordsToSearch[array_rand($wordsToSearch)];
    }
}
