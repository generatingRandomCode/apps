<?php
include "mysql_class.php";
if($_POST["book_name"] ?? "" ){
echo  "start:POST: " . htmlspecialchars( var_export($_POST,true)) . "\n";

$myDB = new mysqli("localhost", "us1","@ARX4z!198p","bibo");

if($myDB -> connect_errno){
    echo "fail!!!!! :  " . $myDB -> connect_error;
    exit();
}
#aufruf als klasse
echo "test1";

$ob = new sqlqu();
echo "test2";
$ob->addBook($myDB,$_POST["book_name"]);

#altes vorghen
// $quer= "INSERT INTO books (book_name) values (\"". htmlspecialchars($_POST["book_name"])  . "\")";
// echo "query: ". $quer . "\n";
// echo "test1 \n";
// if($myDB->query($quer)===true){
//     echo "book added \n";
// }else{
//     echo "ERROR: " . $quer  . "\n" . $myDB->error;
// }
// echo "testend \n";

$myDB->close();

}//end if bookname found

if($_POST["book_id"] ?? "" ){

$myDB = new mysqli("localhost", "us1","@ARX4z!198p","bibo");

if($myDB -> connect_errno){
    echo "fail!!!!! :  " . $myDB -> connect_error;
    exit();
}



$quer= "DELETE FROM books WHERE book_id = ". htmlspecialchars($_POST["book_id"]);
echo "query: ". $quer . "\n";
if($myDB->query($quer)===true){
    echo "book deleted \n";
}else{
    echo "ERROR: " . $quer  . "\n" . $myDB->error;
}
$maxID = "SELECT * FROM books WHERE book_id=(SELECT max(book_id) FROM books)";
$maxID = $myDB ->  query($maxID);
echo "max:id: " . var_export($maxID->fetch_assoc(),true) . "\n";

$myDB->close();

}//end if bookname found
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>helloworld</title>
    </head>
    <body>
        <pre>
            <?php

            echo "helloworld\n";

            $myDB = new mysqli("localhost","us1","@ARX4z!198p","bibo");
            echo "db: " . var_export($myDB,true) . "\n";
            if($myDB -> connect_errno){
                echo "fail!!!!! :  " . $myDB -> connect_error;
                exit();
            }

            $qu1 = "SELECT book_id, book_name FROM books";
            $res = $myDB->query($qu1);

            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    echo "book_id: " . $row["book_id"] . " name: " . $row["book_name"] . "\n";
                }
            }else{
                echo "keine suche gefunden!\n";
            }

            ?>
            <div>
                <form method="post" action="">
                <labl for="book_name">add book name: </labl>
                    <input type="text" id="book_name" name="book_name" placeholder="hier  buchname eingeben" require/>
                    <input type="submit" value="submit" />
                </form>
            </div>
            <div>
                <form method="post" action="">
                <labl for="book_id">delet by id: </labl>
                    <input type="text" id="book_id" name="book_id" placeholder="hier buch id eingeben" require/>
                    <input type="submit" value="submit" />
                </form>
            </div>
        </pre>
    </body>
</html>