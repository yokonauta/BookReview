<?php 
include 'load_first.html';
include 'sqlite-env.php';
require_once('function_select_article.php');
?>
<title>Add new article</title>
<link rel='stylesheet' href='css/table.css'>
<div class="w3-content" style="max-width:1400px">
<?php include 'header.php'; ?>

<?php
    //=== Paging ===
    if(isset($_GET["idx"])){$cursor = (int)$_GET["idx"];}
    else {$cursor = 0;}
    $range=5;
    //print("cursor : $cursor<br>");
?>

<div class="w3-row">

<?php

try{
    //=== AUTHOR ===
    $db = new PDO($db_file);
    $results = $db->query('SELECT * FROM author');
    $db = null;
    $row = $results->fetchAll();
    $autor_id = array();
    $author_array = array();
    foreach($row as $item){
        $author_id[]=$item[0];
        $author_array[]=$item[1] . " , " . $item[2];
        //print("author_id:" . $item[0] . "author:" .$item[1] . " , " . $item[2]."<br>");
    }
    //$author_cnt = count($author_array);
    //=== GENRE ===
    $genre_db = new PDO($db_file);
    $stmt = $genre_db->prepare("SELECT * FROM genre");
    $stmt->execute();
    $genre_result = $stmt->fetchAll();
    $genre_db = null;
    $genre_list_cnt = count($genre_result);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    //include "check_detail.php";

?>

    <div class="w3-col l6 s12">
        <div class="w3-card-4" >
        <div class="w3-panel w3-white" >

            <?php
            try{
			
				$result = select_article_one_page($db_file,$range,$cursor);
				$total = get_total_count($db_file,"article");
				$last=$cursor+$range;
				if ($last>$total)$last=$total;

				print("<table><tr><th>title</th><th>author</th><th>genre</th><th>publicated date</th><th>total : $total</th></tr>");

				foreach($result as list($id,$title,$intro,$body,$author_first_name,$author_last_name,$genre,$pub_date,$state,$image1))
				{
					print("<tr>");
					if ($state == 'Published')$color='#222222';
					else                      $color='#a0a0a0';
					print("<td><font color=$color>$title<font></td>");
					print("<td><font color=$color>$author_first_name,$author_last_name<font></td>");
					print("<td><font color=$color>$genre<font></td>");
					print("<td><font color=$color>$pub_date<font></td>");
				
					// Call Confirm modal dialog + script "submitChk ()"
					print("<td><form name='btnForm' method='post' action='article_delete_execute.php?id=");
					print($id);
					print("&cursor=");
					print($cursor);
					print("' onsubmit='return submitChk()'>");
					print("<input class='w3-btn w3-grey'  type='submit' name='submit' value='del'>");
					print("</form></td>");

					// edit button start
					print("<td><a href='article_edit.php?id=");
					print($id);
					print("&cursor=");
					print($id);
					print("' class='w3-btn w3-grey' >edit</a></td>");
					print("</tr>");
				}
				print("</table><br>");
				// $total, $range, $cursor have been set befor.
				$this_page = "article_add.php";
				include 'pagging.php'; 
				print("<br><br><a href='admin.php' class='w3-btn w3-grey'>Back to admin page</a>");
            }
            catch(PDOException $e) {
				print($e->getMessage());
            }

?>
        <p></p>
        </div>
        </div>
    </div>



    <!--===== Side =====-->
    <div class="w3-col l6">
        <div class='w3-card-4 w3-margin w3-white'>
        <div class="w3-container">
            <!-- Form -->
            <form class="w3-container" align="left" action="article_add_execute.php" method="post" id="article_form" enctype="multipart/form-data">
            <p>      
            <label class="w3-text-gray"><b>Title</b></label>
            <input class="w3-input w3-border w3-light-grey" name="title" type="text" value="" style="width:100%;">
            </p>
            <p>      
            <label class="w3-text-gray" ><b>Introduce</b></label><br>
            <textarea class="w3-light-grey" name="intro" form="article_form" rows="5" cols="80" style="width:100%;height:100px;" align="left"></textarea>
            </p>
            <p>      
            <label class="w3-text-gray"><b>Read more</b></label><br>
            <textarea class="w3-light-grey" name="more" form="article_form" rows="5" cols="80" style="width:100%;height:100px;"></textarea>
            </p>
            <p>
            <label class="w3-text-gray" for="author"><b>Author</b></label>
            <select class="w3-light-grey" name="author" style="width:300px;height:40px;">
            <?php
			$author_cnt = count($author_array);
            if($author_cnt){
                $option_cnt=0;
                for($option_cnt;$option_cnt<$author_cnt;$option_cnt++){
                $a_id = $author_id[$option_cnt]-1;
                    print("<option value='$a_id'");
                    print(">$author_array[$option_cnt]</option>");
                }
            }
            ?>
            </select>
            <p>
            <label class="w3-text-gray" for="genre"><b>Genre</b></label>
            <select class="w3-light-grey" name="genre" style="width:300px;height:40px;">
            <?php 
            if($genre_list_cnt){
                $option_cnt=1;
                foreach($genre_result as $item){
                    print("<option value='" . $item[0] . "'");
                    print(">$item[1]");
                    print("</option>");
                    $option_cnt = $option_cnt + 1;
                }
            }    
            ?>
            </select>
            <p>
            <label class="w3-text-gray" for="pub_date"><b>Publicated</b></label>
            <input class="w3-light-grey" type="date" name="pub_date" size="20" style="width:200px;height:40px;" 
            value="<?php echo date('Y-m-d'); ?>">
            </p>
            <p>
            <label class="w3-text-gray" for="state"><b>State</b></label><br>
            <label><input type="radio" name="state" value="Maintenance" checked >Maintenance</label><br>
            <label><input type="radio" name="state" value="Published" >Published</label><br>
            <label><input type="radio" name="state" value="Deleted" >Deleted</label><br>
            </p>
            <p>
            <label class="w3-text-gray"for="image1"><b>Image1</b></label>
            <input class="w3-btn w3-dark-grey" type="file" name="image1" size="20" accept=".jpg, .jpeg, .png">
            </p>
            <p>
            <input class="w3-btn w3-indigo" type='submit' value='save'>
            </p>
            </form>
        </div><!-- w3-container -->
        </div><!-- w3-card-4 -->
    </div><!--===== Side close =====-->

</div><!--w3-row-->
				<script>
					function submitChk () {
						var flag = confirm ( "Execute?");
						return flag;
					}
				</script>

<?php include "footer.html"; ?>

