<?php
include 'load_first.html';
include 'sqlite-env.php';

print("<title>Article Detail</title>");
include 'header.php';
?>

<div class="w3-row">

<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
try{
    //=== ARTICLE ===
    $file_db = new PDO($db_file);
    $stmt = $file_db->prepare("SELECT * FROM article where id = $id");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $file_db = null;

    list($id,$title,$intro,$body,$author,$genre,$pub_date,$state,$image1,$image2,$image3,$image4) = $result[0];
    //=== AUTHOR ===
    $db = new PDO($db_file);
    $results = $db->query('SELECT * FROM author');
    $db = null;
    $author_result = $results->fetchAll();
    $author_id_array = array();
    $author_array = array();
    foreach($author_result as $item){
        $author_id_array[]=$item[0];
        $author_array[]=$item[1] . " , " . $item[2];
    }
    $author_list_cnt = count($author_result);
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
}
?>

<div class="w3-col l8 s12">

<div class="w3-card-4" >
<div class="w3-panel w3-white" >
<form class="w3-container" align="left" action="article_update.php?id=<?php echo $id; ?>" method="post" id="article_form" enctype="multipart/form-data">
    <p>      
    <label class="w3-text-gray"><b>Title</b></label>
    <input class="w3-input w3-border w3-light-grey" name="title" type="text" value="<?php echo $title; ?>" style="width:50%;">
    </p>
      
    <p>      
    <label class="w3-text-gray" ><b>Introduce</b></label><br>
    <textarea class="w3-light-grey" name="intro" form="article_form" rows="5" cols="180" style="width:100%;height:100px;" align="left"><?php print($intro); ?></textarea>
    </p>

    <p>      
    <label class="w3-text-gray"><b>Read more</b></label><br>
    <textarea class="w3-light-grey" name="more" form="article_form" rows="5" cols="180" style="width:100%;height:100px;"><?php echo $body; ?></textarea>
    </p>

    <p>
    <label class="w3-text-gray" for="author"><b>Author</b></label>
    <select class="w3-light-grey" name="author" style="width:300px;height:40px;">
        <?php
        if($author_list_cnt){
            foreach($author_result as $item){
                print("<option value='$item[0]'");
                if ($item[0]==$author) print(" selected ");
                print(">$item[0]-$item[1],$item[2]");
                print("</option>");
                $option_cnt = $option_cnt + 1;
            }
        }
        ?>
    </select>
    </p>
    <p>
    <label class="w3-text-gray" for="genre"><b>Genre</b></label>
    <select class="w3-light-grey" name="genre" style="width:300px;height:40px;">
        <?php 
        if($genre_list_cnt){
            $option_cnt=1;
            foreach($genre_result as $item){
                print("<option value='$item[0]'");
                if ($item[0]==$genre) print(" selected ");
                print(">$item[0]-$item[1]");
                print("</option>");
                $option_cnt = $option_cnt + 1;
            }
        }    
        ?>
    </select>
    </p>   
    <p>
    <label class="w3-text-gray" for="pub_date"><b>Publicated</b></label>
    <input class="w3-light-grey" type="date" name="pub_date" size="20" style="width:200px;height:40px;" 
        value="<?php if($pub_date) echo $pub_date; else echo date('Y-m-d'); ?>">
</p>
    <p>
    <label class="w3-text-gray" for="state"><b>State</b></label>
    <label><input type="radio" name="state" value="Maintenance" <?php if($state=="Maintenance")echo "checked"; ?> >Maintenance</label>
    <label><input type="radio" name="state" value="Published" <?php if($state=="Published") echo "checked"; ?> >Published</label>
    <label><input type="radio" name="state" value="Deleted" <?php if($state=="Deleted")echo "checked"; ?> >Deleted</label>
    </p>
    <p>
    <label class="w3-text-gray"for="image1"><b>Image1</b></label>
	<input value="<?php echo $image1; ?>"  readonly />&nbsp;<input type="checkbox" name="keep" value="1" checked="checked">Keep<p>
    <input class="w3-btn w3-light-blue" type="file" name="image1" size="20" accept=".jpg, .jpeg, .png">
    </p>
    <p>
    <input class="w3-btn w3-indigo" type='submit' value='save'>
    </p>
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

