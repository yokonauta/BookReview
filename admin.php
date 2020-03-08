<?php include 'load_first.html'; ?>
<title>Admin</title>
<link rel='stylesheet' href='css/table.css'>
<?php include 'header.php'; ?>

<?php
$total_user = 0;
$total_genre = 0;
$total_author = 0;
$total_article = 0;
include 'db_get_count.php';
?>

<div class="w3-row">
    <div class="w3-col l8 s12">
        <div class="w3-card-4" >
        <div class="w3-panel w3-white" >
        <table>
        <tr><th>Table name</th><th>Number of register</th><th></th></tr>
        <tr><td>User</td><td><?php print($total_user); ?></td><td></td></tr>
        <tr><td>Genre</td><td><?php print($total_genre); ?></td><td><a class='w3-btn w3-grey' href="genre_add.php?idx=0">Add/Edit/Delete</a></td></tr>
        <tr><td>Author</td><td><?php print($total_author); ?></td><td><a class='w3-btn w3-grey' href="author_add.php?idx=0">Add/Edit/Delete</a></td></tr>
        <tr><td>Article</td><td><?php print($total_article); ?></td><td><a class='w3-btn w3-grey' href="article_add.php">Add/Edit/Delete</a></td></tr>
        </table>

        </div>
        </div>
    </div>

    <!--===== Side =====-->
    <div class="w3-col l4">
        <!-- About Card -->
        <?php include 'aboutme.html' ?>
    </div><!--===== Side close =====-->
</div>
<?php include "footer.html"; ?>
