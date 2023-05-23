<?php 
    try {
        $conn = new PDO("mysql:host=localhost;dbname=btth02", "root", "");
        // echo "Success";
    }
    catch(PDOException $e) {
        echo "Connect Failed: " . $e->getMessage();
    }

?>