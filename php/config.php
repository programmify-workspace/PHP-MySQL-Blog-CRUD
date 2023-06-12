<?php

    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "blog_data";

    $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName); 

    if ($conn->connect_error){
        die("Couldn't connect");
    }else{
        // echo "<h1 style='color:green; text-align:center;'>Connection successful</h1>";
    }
?>
<h1 style="color: green;"></h1>
