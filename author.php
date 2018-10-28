<?php

namespace book;

/**
 * Generates random author
 * 
 * @author Leif Rogers <leif@leifrogers.com>
 */
class Author
{
    /** 
     * Potential last names. 
     */
    protected $lastName;

    /** 
     * Potential first names. 
     */
    protected $firstName;

    /**
     * Constructor - imports files for first and last names
     */
    public function __construct()
    {
        $this->lastName = file(__DIR__ . '/lastName.txt', FILE_IGNORE_NEW_LINES);
        $this->firstName = file(__DIR__ . '/firstName.txt', FILE_IGNORE_NEW_LINES);
    }

    /**
     * Gets a randomly generated name.
     *
     * @return string A random name.
     */
    public function getAuthor()
    {
        $lastName = ucwords(strtolower($this->getRandomWord($this->lastName)));
        $firstName = ucwords(strtolower($this->getRandomWord($this->firstName)));
        return ucwords("{$firstName} {$lastName}");
    }

    /**
     * Get a random name
     *
     * @param array $words array of words
     * 
     * @return string The random name.
     */
    protected function getRandomWord(array $words)
    {
        return $words[array_rand($words)];
    }
}