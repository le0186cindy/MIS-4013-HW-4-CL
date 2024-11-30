<?php
    function get_db_connection(){
        // Create connection
        $conn = new mysqli('localhost', 'root', 'pass', 'cindyleo_hw4');
        
        // Check connection
        if ($conn->connect_error) {
          return false;
        }
        return $conn;
    }
?>