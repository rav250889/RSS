<?php

$email = $_POST['email'];
$feed = $_POST['rss'];
$url = $_POST['rss'];
$invalidurl = false;

if(@simplexml_load_file($url))
{
    $feeds = simplexml_load_file($url);
}

$i = 0;

if(!empty($feeds))
{
    $site = $feeds->channel->title;

    $sitelink = $feeds->channel->link;

    foreach ($feeds->channel->item as $item)
    {
        $title = $item->title;

        $link = $item->link;

        $description = $item->description;

        if($i >= 5)
        {
            break;
        }
        
        include 'connectionDB.php';
        
        $add = "INSERT INTO rss (id, user, feed, title, link) VALUES ('$i', '$email', '$feed', '$title', '$link')";
        
        if ($connection->multi_query($add) === TRUE);    
        
        mysqli_close($connection);
        
        ?>

        <?php
        
        $i++;
    }
}
?>