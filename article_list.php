<?php 
include "load_first.html"; 
include 'sqlite-env.php';
include 'js/jump_listbox.js';
require_once("function_select_article.php");
?>

<title>article list</title>
<link rel='stylesheet' href='css/table.css'>
<div class="w3-content" style="max-width:1400px">
<?php include 'header.php'; ?>

<?php
    //=== Paging ===
    if($_GET["idx"]){$cursor = (int)$_GET["idx"];}
    else {$cursor = 0;}
    $range=5;
    //print("cursor : $cursor<br>");
    if (isset($_GET['filter'])) {
        if($_GET["filter"]){$filter = (int)$_GET["filter"];}
    }
    else {$filter = 1;}
?>

<?php
	
	$genre_result = total_count_genre($db_file);
	$genre_list_cnt = count($genre_result);

?>

<br>
<form class="w3-container" align="left" action="#" name="form1" id="filter_form">
            <label class="w3-text-gray" for="genre_list"><b>Genre</b></label>
            <select class="w3-light-grey" name="select" style="width:300px;height:40px;"  onChange="jump()">
            <?php 
            if($genre_list_cnt){
                $option_cnt=1;
                foreach($genre_result as $item){
                    print("<option value='article_list.php?idx=0&filter=" . $item[0] . "'");
                    if ($item[0] == $filter) print(" selected ");
                    print(">$item[0] - $item[1]");
                    print("</option>");
                    $option_cnt = $option_cnt + 1;
                }
            }    
            ?>
            </select>
    <!--input class="w3-btn w3-indigo" type="submit" name="filter" value="Filter"-->
</form>

<?php

	$result = select_article_by_genre_for_list($db_file,$filter,$range,$cursor);
	$total = total_count_by_genre($db_file,$filter);
	
    //print ("<br>total rows : " . $total);
    if ($total == 0) {
    print("There is no data.<br>");}
    else {
    $last=$cursor+$range;
    if ($last>$total)$last=$total;

    $db = null;

    print("<table><tr><th>id</th><th>title</th><th>author</th><th>genre</th><th>pub_date</th></tr>");
    foreach($result as list(
        $id,
        $title,
        $intro,
        $body,
        $author_first_name,
        $author_last_name,
        $genre,
        $pub_date,
    ) )
    {
        print("<tr>");
        print("<td>$id</td>");
        print("<td><a href='article_detail.php?id=" . $id ."'>$title</a></td>");
        print("<td>$author_first_name,$author_last_name</td>");
        print("<td>$genre</td>");
        print("<td>$pub_date</td>");
        print("</tr>");



    }
    print("</table><br>");
}

            //=== PAGGING === 
            // $total, $range, $cursor have been set befor.
            $this_page = "article_list.php";
            include 'pagging.php'; 
            print("<br><br>");

?>


<?php include "footer.html"; ?>
</div><!-- END w3-content -->
</body>
<html>