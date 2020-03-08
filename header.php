<link rel="stylesheet" href="css/login_modal.css">
<link rel="stylesheet" href="css/header.css">

<?php
session_start();
$user_id = null;
include 'session_verify.php'; 
if (isset($_SESSION['user_id']))
{
    $user_id = $_SESSION["user_id"];
}

?>
</head>
<body>
<header class="bgimg w3-display-container w3-center w3-grayscale-min" id="home">
  <h1><b>Sample Project</b></h1>
  Welcome to my book review
</header>

<div class="w3-container w3-teal" style="height:45px;">

  <a href="index.php" class='w3-btn w3-teal'>Home</a>
  <a href="article_list.php?idx=0&filter=1" class='w3-btn w3-teal'>List</a>
  <!--button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button-->
  <?php
        if ($user_id==null){
  ?>
            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
  <?php
        } else {
            print("<a href='admin.php' class='w3-btn w3-teal'>Admin</a>");
            print("<a href='session_destroy.php' class='w3-btn w3-teal'>logout</a>");
        }
  ?>
</div>


<div id="id01" class="modal">
<div class="w3-content" style="max-width:400px">

  <form class="modal-content animate" action="session_start.php" enctype="multipart/form-data" method="post" >
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img/avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pass" required>
  
      <button class="w3-btn w3-indigo"  type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
