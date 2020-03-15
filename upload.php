<?php
 
$uploadfile = 'C:\Apache24\htdocs\temp\temp.png';

$target_dir = "../UploadedImages/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
print("<br>target : " . $target_file);

//print("<br>image : " . $_FILES['image']['tmp_name']); 
if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
echo '<br>ok';
}
else{
echo '<br>error';
} 
