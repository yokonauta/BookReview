<?php
include 'sqlite-env.php';
if (isset($_POST['genre'])) {
    $genre = $_POST['genre'];

    try {
        $db = new PDO($db_file);
        $sql = "insert into genre (name)";
        $sql = $sql . " values ('" . $genre . "')";
        //print($sql);
        $stmt = $db->prepare($sql);
        $stmt->execute();


        $sql = "SELECT * FROM genre";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $last = count($result)-1;
        //print("genre count : $last");
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    $db = null;
}
//redirect
header('Location: genre_add.php?idx=' . $last);

?>