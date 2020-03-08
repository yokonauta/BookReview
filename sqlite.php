<?php
$db = new SQLite3('bookreview.sqlite3');

$result = $db->query('SELECT * FROM author');
while ($row = $result->fetchArray()) {
echo $row[0] . "\n";
echo $row[1] . "\n";
echo $row[2] . "\n";
echo "<p>";
}

?>