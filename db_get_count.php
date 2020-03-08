<?php
    include 'sqlite-env.php';
    try{
        $db = new PDO($db_file);
        $sql = "SELECT COUNT(*) FROM user";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $total_user = $stmt->fetchColumn();

        $sql = "SELECT COUNT(*) FROM genre";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $total_genre = $stmt->fetchColumn();

        $sql = "SELECT COUNT(*) FROM author";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $total_author = $stmt->fetchColumn();

        $sql = "SELECT COUNT(*) FROM article";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $total_article = $stmt->fetchColumn();

        $db = null;
    }
    catch(PDOException $e){
        print($e->getMessage());
    }