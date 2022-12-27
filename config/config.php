<?php

try{

    $host = "localhost";
    $dbname = "jobboard";
    $username = "root";
    $pass = ""; 

    $conn = new PDO("mysql:host=$host;dbname=$dbname" ,$username , $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo $e->getMessage() ; 
}
    // if($conn == true){
    //     echo "connected successfully";
    // }else{
    //     echo "error";
    //   }