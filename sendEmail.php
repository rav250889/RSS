<?php
include 'connectionDB.php';

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
?>