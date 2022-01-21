<?php
    include "conn.php";//Including connection of php with the database using the php connection page
    if (isset($_GET['id'])){ //if there is an id in the page we set a query to delete
        $id = $_GET['id'];
        $query = "delete from users where id='$id'";
        if (mysqli_query($conn, $query)){ //running the query inside if, below means if the query was able to work to delete the data/id
            header('location: view_users.php?message="USER DELETED"');//means if the data/id was succefully deleted we should be taken back to the view_users page
        }else{ //To return in the view_users page with an error
            header('location: view_users.php?error');
        }
    }
?>