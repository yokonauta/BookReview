<?php
include 'sqlite-env.php';
?>

<?php
$db = new SQLite3($db_file);

$result = $db->query('SELECT * FROM author');
while ($row = $result->fetchArray()) {
echo $row[0] . "\n";
echo $row[1] . "\n";
echo $row[2] . "\n";
echo "<p>";
}

?>