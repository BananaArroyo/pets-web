<?php
//  Connection to Database
    function connect() {
        static $conn;
        if ($conn === NULL){ 
            $conn = mysqli_connect('localhost','root','','socialnetwork');
        }
        return $conn;
    }
?>