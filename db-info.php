<?php
    function get_db_connection(){
        // Create connection
        $conn = new mysqli('138.197.17.168', 'cindyleo_cindy', 'L00pyle245', 'cindyleo_hw4');
        
        // Check connection
        if ($conn->connect_error) {
          return false;
        }
        return $conn;
    }
?>
