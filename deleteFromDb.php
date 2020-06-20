<?php

include 'connectionDB.php';

$sql = "DELETE FROM rss";

if ($connection->multi_query($sql) === TRUE)
{
    echo "*Data was delete from database.";
}
else
{
    echo "Error deleting record: " . mysqli_error($connection);
}

mysqli_close($connection);
?>