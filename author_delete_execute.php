<?php
$idx = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $idx = $_GET['cursor'] - 1;
    try {
        $db = new PDO('sqlite:sqlite3/bookreview.sqlite3');
        $sql = "delete from author where id =" . $id;
        //print($sql);
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    $db = null;
}
//redirect
header('Location: author_add.php?idx=' . $idx);
?>