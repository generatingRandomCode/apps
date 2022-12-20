<?php

class sqlqu{
    public function addBook($db,$book){
        $quer = "INSERT INTO books (book_name) values (\"". $book  . "\")";
        $db->query($quer);
    }
}


?>