<?php

//---------DOWNLOAD RSS AND SAVE TO DB-----------------------------------------------------------------------------------

$email = "rafalwalach89@gmail.com";
$url = "https://tvn24.pl/najnowsze.xml";
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

        if($i >= 1)
        {
            break;
        }
        
        $connection = mysqli_connect("localhost", "newuser", "123", "rss");
        $add = "INSERT INTO rss (id, user, feed, title, link) VALUES ('$i', '$email', '$url', '$title', '$link')";
        
        if ($connection->multi_query($add) === TRUE);    
        
        mysqli_close($connection);
        
        ?>

        <?php
        
        $i++;
    }
}
//---------END DOWNLOAD RSS AND SAVE-------------------------------------------------------------------------------------

//---------DISPLAY RSS FROM DB-------------------------------------------------------------------------------------------
$connection = mysqli_connect("localhost", "newuser", "123", "rss");
$sql = "SELECT * FROM rss";

$result = mysqli_query($connection, $sql) or die("Bad Query: $sql");

while($row = mysqli_fetch_assoc($result))
{
    echo "{$row['title']},' '<a href='{$row['link']}'>{$row['link']}</a><br><br>";
}
//---------END DISPLAY RSS-----------------------------------------------------------------------------------------------

//---------SENDING EMAIL-------------------------------------------------------------------------------------------------
$connection = mysqli_connect("localhost", "newuser", "123", "rss");

$sql = "SELECT * FROM rss";

$result = mysqli_query($connection, $sql) or die("Bad Query: $sql");
while($row = mysqli_fetch_assoc($result))
{
    $email = "{$row['user']}";
    
    $body = "{$row['title']},' '<a href='{$row['link']}'>{$row['link']}</a><br><br>";

    $name = "Rafal W.";
    
    $subject = "RSS";
    
    $api = "SELECT * FROM send";
    
    $resultApi = mysqli_query($connection, $api) or die("Bad Query: $api");
    
    while($row = mysqli_fetch_assoc($resultApi))
    {
        $unlock = "{$row['api']}";
        
        $headers = array (
            
            "Authorization: Bearer $unlock",

            'Content-Type: application/json'
        );

    }
    $name = "Rafal W.";
    
    $subject = "RSS";

    $data = array (
        
            "personalizations" => array (
                
                array 
                (
                    
                    "to" => array
                    (
                        
                        array
                        (

                            "email" => $email,

                            "name" => $name
                        )
                    )
                )
            ),
            "from" => array (
                
                    "email" => "RSS@fromApplication.pl"
            ),
        
            "subject" => $subject,
        
            "content" => array (
                
                array
                (
                    
                    "type" => "text/html",
                    
                    "value" => $body
                )
            )
    );

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
    
    curl_setopt($ch, CURLOPT_POST, 1);
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec($ch);
    
    curl_close($ch);
}
//---------END SENDING EMAIL---------------------------------------------------------------------------------------------

//---------DELETE RSS FORM DB--------------------------------------------------------------------------------------------
$connection = mysqli_connect("localhost", "newuser", "123", "rss");
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
//---------END DELETE RSS------------------------------------------------------------------------------------------------
?>