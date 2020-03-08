<?php
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $db = new PDO('sqlite:sqlite3/bookreview.sqlite3');
        $sql = "delete from article where id =" . $id;
        //print($sql);
		
        //$stmt = $db->prepare($sql);
        //$stmt->execute();
    }
    catch(PDOException $e) {
        print($e->getMessage());
    }
    $db = null;
    $id = $id - 1;
}
//redirect
//header('Location: article_add.php?idx=' . $id);
header('Location: article_add.php?idx=0');
?>