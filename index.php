<?php
include 'load_first.html';
include 'sqlite-env.php';
require_once('function_select_article.php');

?>

<title>Home</title>
<div class="w3-content" style="max-width:1400px">

<?php include 'header.php';?>

<div class="w3-row">
    <!--===== Contents =====-->
	<!-- Blog entries -->
	<div class="w3-col l8 s12">
    <!-- Blog entry -->
    
<?php
	$result = select_article_firstpage($db_file,2);	
    if ($result){
    $cnt=1;
    foreach($result as list($id,$title,$intro,$body,$author_first_name,$author_last_name,$genre,$pub_date,$state,$image1))
    {  
        print("<div class='w3-card-4 w3-margin w3-white'>");

        print("<div class='w3-container'><h3><b>$title</b></h3>");
        print("<h5>$author_first_name,$author_last_name<span class='w3-opacity'>&nbsp;$pub_date</span></h5></div>");
		print("<div class='w3-container'>");
        print("<img src='$image_directory$image1' height='150' />");
		print("</div>");

        print("<div class='w3-container'><input type='checkbox' class='read-more-state' id='post-$cnt' />");
        print("<p class='read-more-wrap'>");
        print($intro);
        print("<span class='read-more-target'>");
        print($body);
        print("<br><br></span></p>");
        print("<label for='post-$cnt' class='read-more-trigger'></label>");
        print("</div><br>");

        print("</div><!-- w3-card-4 -->");
        $cnt = $cnt + 1;
        
    }
    }
    else{
        print("No data");
    }
    
?>
    <!-- END BLOG ENTRIES -->
    </div><!-- w3-col l8 s12 -->


    <!--===== Side =====-->
    <div class="w3-col l4">
        <!-- About Card -->
        <?php include 'aboutme.html' ?>
        <hr>
        <!-- Labels / tags -->
        <?php include 'tags.php';?>
    </div><!--===== Side close =====-->

    </div><!--== w3-row"  -->

</div><!-- END w3-content -->


<?php include 'footer.html'; ?>