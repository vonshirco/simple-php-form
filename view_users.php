<?php //including connection of the database so as to show the users
    include "conn.php";
    $query = "select * from users"; //query to select all users in the databases
        $run = mysqli_query($conn, $query); //So as to run the query
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    
    <body>
        <h1>VIEW AND MANAGE USERS</h1>
        
        <table border="1" cellpadding="10px" cellspacing="0px"> <!--border=border in our table, cellpadding=padding with the words in the table, cellspacing=spaces between the cells-->
            <tr>
                <th>User Name</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Operation</th> <!--For updating and deleting button-->
            </tr>
        
        <?php //here there are two ways, this is the first
            while($data = $run->fetch_assoc()){ //way of fetching data from the database called PDO $data =.. means the $data will be equal to one row in the table, thus every time one row is fetched
                echo "<tr>
                        <td>" . $data['username'] . "</td>
                        <td>" . $data['full_name'] . "</td>
                        <td>" . $data['dateofbirth'] . "</td>
                        <td>" . $data['gender'] . "</td>
                        <td>".   // below means in the id will come that user who was listed
                        "<a href='edit_user.php?id=".$data['id']."'>Edit<a>
                        <a href='delete_user.php?id=".$data['id']."'>Delete<a>
                        </td>"; 
        }
        ?>    
     </table>  
    <!--To Show if data has been deleted or not, if not to display/show the error-->
        <?php
            if (isset($_GET['error'])){ //If an error message was receive by the system then we return it to be displayed on our page
                echo '
                <div class="error">
                    <h2>There was an Error!</h2> 
                </div>'; 
            } if(isset($_GET['message'])){ //If a succeful message was received by the system then we will return it to be displayed on our page
                echo '
                <div class="message">
                    <h2> 
                         ' . $_GET['message'] . ' 
                     </h2>
                </div>';
            }
        ?>
    </body>
</html>