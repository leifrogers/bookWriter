<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <div>
    <h2>
        <?php 
        require 'title.php';
        $title = new \book\Title;
        echo $title->getTitle();
        ?>
    </h2>
    <h4>
        <?php 
        require 'author.php';
        $author = new \book\Author;
        echo $author->getAuthor();
        ?>
    </h4>
    <hr>
    <?php 
    require 'bookWriter.php';
    $book = new \book\BookWriter;
    echo $book->writeBook('html');
    ?>
    </div>
</body>
</html>












