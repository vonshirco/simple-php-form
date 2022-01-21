<?php //How to do Connection of Database in php
    $host = 'localhost';
    $username = 'root';
    $pwd = '';
    $db = 'myfirstdb';
    $conn = mysqli_connect($host, $username, $pwd, $db);
    //$conn = mysqli_connect('localhost', 'root', '', 'myfirstdb'); //function for enabling connection (host,username(root by default),password<not yet>,database_name,)
        if (!$conn){ #condition it there is no connection
            die("Connection Failed!"); #means to exit the php command (skip)   
        }
?>