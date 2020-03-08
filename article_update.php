<?php 
include "load_first.html"; 
include 'sqlite-env.php';
?>
<title>Article Detail</title>
<link rel='stylesheet' href='css/table.css'>
<?php include 'header.php'; ?>

<!--?php include "check_post_data.php"; ?-->

<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    try{
        //=== AUTHOR ===
        $db = new PDO($db_file);
        $results = $db->query('SELECT id,first_name, last_name FROM author');
        $db = null;
        $row = $results->fetchAll();
        $author_id = array();
        $author_array = array();
        foreach($row as $item){
            $author_id[] = $item[0];
            $author_array[]=$item[1] . " , " . $item[2];
        }

        //=== PREPAIR UPDATE STRINGS (ex: don't) ===
        $intro = str_replace("'", "&#39;", $_POST['intro']);
        $body  = str_replace("'", "&#39;", $_POST['more']);
        //=== PREPAIR UPLOAD IMAGE FILE ===
        $target_dir = "UploadedImages/";
        $file_name = basename($_FILES['image1']['name']);
        $target_file = $target_dir . $file_name;

        //=== UPDATE DATA ===
        $sql = "update article set ";
        $sql = $sql . "title = '" . $_POST['title'] . "',intro = '" . $intro . "',body = '" . $body . "',";
        $sql = $sql . "author_id = " . $_POST['author'] . ",genre = " . $_POST['genre'] . ",pub_date = '" . $_POST['pub_date'] . "',";
        $sql = $sql . "state = '" . $_POST['state'] . "'";
		if ($keep==true){
			$sql = $sql . "',image1 = '" . $file_name. "'";
        }
		$sql = $sql . " where id = " . $id;
        $db = new PDO($db_file);
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        //=== IMAGE UPLOAD EXECUTE =================================
        //--- Overerite si exist same name
        // $_FILES['image1'] from Form
        // $target_file ex:'UploadedImages/the bone collection.png'
        //----------------------------------------------------------  
        include 'upload_image.php';
    }
    catch(PDOException $e) {
        print($e->getMessage());
    }
}
?>
<title>article updated</title>
</head>
<body>
<div class="w3-row">
    <!--Contents-->
    <div class="w3-col l8 s12">
        <div class="w3-card-4" >
            <div class="w3-panel w3-white" >
                <!--?php include "check_post_data.php"; ?-->
                <h1>article updated</h1>
                <table border='0px'>
                    <tr><td>Title</td><td><?php print($_POST['title']) ?></td></tr>       
                    <tr><td>Introduce</td><td><?php print($_POST['intro']) ?></td></tr>       
                    <tr><td>Read more</td><td><?php print($_POST['more']) ?></td></tr>       
                    <tr><td>Author</td><td><?php print($_POST['author']) ?></td></tr>       
                    <tr><td>Genre</td><td><?php print($_POST['genre']) ?></td></tr>       
                    <tr><td>Published date</td><td><?php print($_POST['pub_date']) ?></td></tr>       
                    <tr><td>State</td><td><?php print($_POST['state']) ?></td></tr>
                    <tr><td>Image1</td><td><?php print($file_name); ?></td></tr>
                </table>
                <br><a href='article_add.php' class='w3-btn w3-grey'>Back to list</a>
                <br><br>
            </div>
        </div>
    </div>

    <!--Side-->
    <div class="w3-col l4">
        <!-- About Card -->
        <?php include 'aboutme.html' ?>
    </div>

</div><!--w3-row-->

<?php include "footer.html"; ?>
