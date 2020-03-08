<?php
include 'load_first.html';
print("<title>show articles</title>");
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    //=== ARTICLE ===
    $file_db = new PDO('sqlite:sqlite3/bookreview.sqlite3');
    $sql = "SELECT article.id,title,intro,body,author.first_name,author.last_name,genre,pub_date,state,image1";
    $sql = $sql . " FROM article";
    $sql = $sql . " INNER JOIN author ON article.author_id = author.id";
    $sql = $sql . " where article.id = $id";
    $stmt = $file_db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $file_db = null;
}
?>
<div class="w3-content" style="max-width:1400px">
<?php include 'header.php';?>


<div class="w3-row">
    <!--===== Contents =====-->
<!-- Blog entries -->
<div class="w3-col l8 s12">
    <!-- Blog entry -->
    
<?php
    if ($result){
    $cnt=1;
    foreach($result as list($id,$title,$intro,$body,$author_first_name,$author_last_name,$genre,$pub_date,$state,$image1))
    {  
        print("<div class='w3-card-4 w3-margin w3-white'>");

        print("<div class='w3-container'><h3><b>$title</b></h3>");
        print("<h5>$author_first_name,$author_last_name<span class='w3-opacity'>&nbsp;$pub_date</span></h5></div>");

        print("<img src='UploadedImages/$image1' height='150' />");
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