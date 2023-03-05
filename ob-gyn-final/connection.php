<?php

    $database = new mysqli("localhost", "root", "", "ob");
    if ($database->connect_error) {
        die("Connection failed: ".$database->connect_error);
    }

?>