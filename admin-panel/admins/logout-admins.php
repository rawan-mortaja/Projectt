<?php

    session_start();
    session_unset();
    session_destroy();


    header("location: http://localhost:8080/jobboard/admin-panel/admins/login-admins.php");

    


?>