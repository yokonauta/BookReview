<?php
    session_start();
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200))
    {
        session_destroy(); 
    }


    $message="";
    //print("authentication<br>");
    if(isset($_POST["uname"])) {
        //print("user name : " . $_POST['uname'] . "<br>");
        //print("password : " . $_POST['pass'] . "<br>");

        $table_name = "user";
        try{
			include 'sqlite-env.php';
            $db = new PDO($db_file);
            $sql = "SELECT COUNT(*) FROM " . $table_name;
            $sql = $sql . " WHERE uname='" . $_POST['uname'] . "' AND password ='" . $_POST['pass'] ."'";
            print("sql : " . $sql . "<br>");
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $total = $stmt->fetchColumn();
            if ($total!="0"){
                $_SESSION["user_id"]=$_POST['uname'];
                $_SESSION['LAST_ACTIVITY'] = time();

                $message = "login ok";
                header("Location:http:admin.php");
                exit();
            }
            else {
                $message="Invalid Username or Password.";
                header('Location:index.php');
                exit();
            }
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
        } 
        print($message);
    }
?>
