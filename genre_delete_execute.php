<?php
include 'sqlite-env.php';
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $db = new PDO($db_file);
        $sql = "delete from genre where id =" . $id;
        print($sql);
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    $db = null;
    $id = $id - 1;
}
//redirect
header('Location: genre_add.php?idx=' . $id);
?>