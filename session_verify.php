<?php
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1000))
{
    include 'session_destroy.php';
} else {
    if(isset($_SESSION['user_id'])) $_SESSION['LAST_ACTIVITY'] = time();
}
?>