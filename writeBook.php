<?php

namespace book;
require 'title.php';
require 'author.php';
require 'bookWriter.php';

$title = new \book\Title;
$author = new \book\Author;
$book = new \book\BookWriter;

echo $title->getTitle();
echo ("\n\r\n\r");
echo $author->getAuthor();
echo ("\n\r\n\r");
for ($i = 0; $i<80; $i++) {
    echo("=");
}
echo ("\n\r\n\r");
echo $book->writeBook('standard');