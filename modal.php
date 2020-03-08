<link rel="stylesheet" href="css/verify_modal.css">
<div class="w3-container w3-teal" style="height:45px;">
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Delete</button>
</div>

<?php $message = "Execute?"; ?>


<div id="id01" class="modal">
<div class="w3-content" style="max-width:400px">

  <form class="modal-content animate" action="delete_XXX.php" enctype="multipart/form-data" method="post" >
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
	    <img src="img/much16.png" 
            onMouseOver=this.src="img/much163.gif" 
            onMouseOut=this.src="img/much16.png" 
            style="width:30%">

	<center>
	 <h3><?php print($message); ?></h3>
	</center>
    </div>
	
    <div class="container" style="background-color:#aaa">
	 <center>
		<button type="submit" class="okbtn" >Exetute</button>
		<button type="button" class="cancelbtn" onclick="document.getElementById('id01').style.display='none'" >Cancel</button>
	 <center>
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