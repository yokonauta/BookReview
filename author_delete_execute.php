<?php
include "sqlite-env.php";
$idx = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $idx = $_GET['cursor'] - 1;
    try {
        $db = new PDO($db_file);
		// Get article count which using the author
		$sql = "select count(*) from article where author_id = " . $id; 
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $total_article = $stmt->fetchColumn();
		if($total_article==0){
			// There is no article 
			$sql = "delete from author where id =" . $id;
			print($sql);
			$stmt = $db->prepare($sql);
			$stmt->execute();
		}
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    $db = null;
}
//redirect
header('Location: author_add.php?idx=' . $idx);
?>