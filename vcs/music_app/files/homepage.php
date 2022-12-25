<?php

//hier function 
//-music hochladen
//einordnen mit informationen 
//music runterladen
//music abspielen 

//1 alle music stücke 
require_once "../config/twig_loader.php";
require_once "../config/mysql_connection.php";

// $query = "SELECT * FROM music;";
// $prep = $db -> prepare($query);
// $prep -> execute();
// $res = $prep -> fetchAll(PDO::FETCH_ASSOC);
// echo "res: " . var_dump($res,true) . "\n";
if (isset($_POST["name"])) {
    addMusicToDb($_POST["name"]);
}
/**
 * @param string $name
 * uploads music information into db
 */
function addMusicToDb(string $name): void
{
    $db = $GLOBALS["db"];
    $query = "INSERT INTO music (music_name,played) VALUES (?,0)";
    $prep = $db->prepare($query);
    $prep->bindValue(1, $name, PDO::PARAM_STR);
    unset($_POST["name"]);
    if ($prep->execute()) {
        $_SESSION["ERROR"] = "music title successfully uploaded.";
        //prevents multiple commits for same item 
        header("Location: ", true);
        // return true;
    }
    // return false;
    $_SESSION["ERROR"] = "there was an error uploading youre file.";
    header("Location: ", true);
}
/**
 * returns array with all music in db
 */
function dispalyMusicInDb(): array
{
    $db = $GLOBALS["db"];
    $query = "SELECT * FROM music;";
    $prep = $db->prepare($query);
    if ($prep->execute()) {
        $res = $prep->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    $_SESSION["ERROR"] = "can't get music_db information.";
    return [];
}


$twigRenderValues = [
    "post" => var_export($_POST, true),
    "ERROR" => $_SESSION["ERROR"] ?? "",
    "music_db" => dispalyMusicInDb()
];
//clear $_SESSION["ERROR"]
unset($_SESSION["ERROR"]);
echo $twig->render("template_homepage.html.twig", $twigRenderValues);
