
<?php

$mysqli = mysqli_connect("127.0.0.1", "root", "", "test");
if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
} else {
    $mysqli->set_charset("utf8");
}
echo "connected<p>";

// insert
$array = array("Jhon","Scott","Tom");
for($i=0; $i<3; $i++) 
 {
	$sql = "insert into test.user (id,name) values ("
		. $i 
		. ",'"
		. $array[$i]
		. "')";
	echo $sql;
	echo "<P>";
	$res = $mysqli->query($sql);
	echo "insert return : ";
	echo  $res;
	echo "<p>";
	if ($res != "1") {
		echo "insert error";
		echo "<P>";
		break;
	}
 }
 
// Select

	$sql = "select * from test.user";
	$stmt = $mysqli->query($sql);
	foreach ($stmt as $row) {
		echo $row['id'].'：'.$row['name'];
		echo '<br>';
	}



 	$sql = "delete from test.user";
	$res = $mysqli->query($sql);





$res = $mysqli->close();
echo "return : ";
echo  $res;
?>