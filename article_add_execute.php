<?php
include sqlite-enc.php;

if (isset($_POST['title'])) {
    $title    = $_POST['title'];
    $intro    = $_POST['intro'];
    $intro = str_replace("'", "&#39;", $intro);
    $body     = $_POST['more'];
    $body = str_replace("'", "&#39;", $body);
    $author   = $_POST['author'] + 1;
    $genre    = $_POST['genre'];
    $pub_date = $_POST['pub_date'];
    $state    = $_POST['state'];

    $target_dir = "UploadedImages/";
    $file_name = basename($_FILES['image1']['name']);
    $target_file = $target_dir . $file_name;

    try {
        $db = new PDO($db_file);

        $sql = "insert into article (title,intro,body,author_id,genre,pub_date,state,image1)";
        $sql = $sql . " values ('" . $title . "','" . $intro . "','" . $body . "','";
        $sql = $sql . $author . "','" . $genre . "','" . $pub_date . "','";
        $sql = $sql . $state . "','" . $file_name . "')";
        //print($sql);
        $stmt = $db->prepare($sql);
        $stmt->execute();


        $sql = "SELECT * FROM article";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $last = count($result)-1;
        //print("article count : $last");

        $db = null;

        //=== IMAGE UPLOAD EXECUTE =================================
        //--- Overerite si exist same name
        // $_FILES['image1'] from Form
        // $target_file ex:'UploadedImages/the bone collection.png'  
        include 'upload_image.php';
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }

}
//redirect
header('Location: article_add.php?idx=0');
//echo 'Location: http://127.0.0.1/author_add.php?idx=0';

?>