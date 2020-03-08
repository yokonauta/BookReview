<?php
include "sqlite-env.php";
if (isset($_POST['first_name']) && $_POST['last_name']) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    try {
        $db = new PDO($db_file);
        $sql = "insert into author (first_name,last_name)";
        $sql = $sql . " values ('" . $first_name . "','" . $last_name . "')";
        //print($sql);
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $sql = "SELECT * FROM author";
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
header('Location: author_add.php?idx=' .  $last);
//echo 'Location: http://127.0.0.1/author_add.php?idx=' . $last;

?>