<?php include 'load_first.html';?>
<?php include 'sqlite-env.php';?>

<title>Add new author</title>
<link rel='stylesheet' href='css/table.css'>
<div class="w3-content" style="max-width:1400px">
<?php include 'header.php' ?>

<?php
    //=== Paging ===
    if($_GET["idx"]){$cursor = (int)$_GET["idx"];}
    else {$cursor = 0;}
    $range=5;
    //print("cursor : $cursor<br>");
?>
<div class="w3-row">
    <!--Contents-->
    <div class="w3-col l8 s12">
        <!-- list -->
        <div class='w3-card-4 w3-margin w3-white'>
        <div class='w3-container'>
            <?php
            $table_name = "author";
            try{
            $db = new PDO($db_file);
            $sql = "SELECT * FROM " . $table_name;
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $db = null;
            $id_array = array();
            $item_array = array();
            foreach($result as $item){
                $id_array[] = $item[0];
                $item_array[]=$item[1] . " , " . $item[2];
            }
            $total = count($item_array);
            print("<table><tr><th>id</th><th>name</th><th></th></tr>");
            $last=$cursor+$range;
            if ($last>$total)$last=$total;
 
            for ($i=$cursor; $i<$last; $i++){
                print("<tr>");
                print("<td>" . $id_array[$i] . "</td>");
                print("<td>" . $item_array[$i] . "</td>");
                print("<td><a href='author_delete_execute.php?id=");
                print($id_array[$i]);
                print("&cursor=");
                print($cursor);
                print("' class='w3-btn w3-grey' >delete</a></td>");
                print("</tr>");
            }

            print("</table><br>");

            //=== PAGGING === 

            // $total, $range, $cursor have been set befor.
            $this_page = "author_add.php";
            include 'pagging.php'; 

            print("<br><br><a href='admin.php' class='w3-btn w3-grey'>Back to admin page</a>");
            }
            catch(PDOException $e) {
            print($e->getMessage());
            }
            ?>
            <p></p>
        </div><!-- w3-container -->
        </div><!--w3-card4 close-->
    </div><!--w3-col close-->

    <!--===== Side =====-->
    <div class="w3-col l4">
        <div class='w3-card-4 w3-margin w3-white'>
        <div class='w3-container'>
            <!-- Form -->
            <form class="w3-container" align="left" action="author_add_execute.php" method="post" id="author_form">
            <p><label class="w3-text-gray"><b>First name</b></label>
            <input class="w3-input w3-border w3-light-grey" name="first_name" type="text" value="" style="width:100%;"></p>
            <p><label class="w3-text-gray"><b>Last name</b></label>
            <input class="w3-input w3-border w3-light-grey" name="last_name" type="text" value="" style="width:100%;"></p>
            <p><input class="w3-btn w3-indigo" type="submit" name='insert' value='add'></p>
            </form>
        </div><!-- w3-container -->
        </div><!-- w3-card-4 -->
    </div><!--===== Side close =====-->

    </div><!--w3-row-->
<?php include "footer.html"; ?>
</div><!-- END w3-content -->


