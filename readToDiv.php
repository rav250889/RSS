<?php

include 'connectionDB.php';

$sql = "SELECT * FROM rss";

$result = mysqli_query($connection, $sql) or die("Bad Query: $sql");

while($row = mysqli_fetch_assoc($result))
{
    echo "{$row['title']},' '<a href='{$row['link']}'>{$row['link']}</a><br><br>";
}

?>