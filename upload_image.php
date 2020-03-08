<?php
    // $_FILES['image1'];
    //$target_dir = "UploadedImages/";
    //$target_file = $target_dir . basename($_FILES['image1']['name']);
    try{
        move_uploaded_file($_FILES['image1']['tmp_name'], $target_file);
    } 
    catch(PDOException $e) {
        print($e->getMessage());
    }
?>
