<?php 
session_start();
session_destroy();
$_SESSION['user_id'] = null;
header('Location: index.php');
?>