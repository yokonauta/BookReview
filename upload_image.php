<?php
    $target_file = $image_directory . basename($_FILES['image1']['name']);
    try{
        move_uploaded_file($_FILES['image1']['tmp_name'], $target_file);
    } 
    catch(PDOException $e) {
        print($e->getMessage());
    }
?>
