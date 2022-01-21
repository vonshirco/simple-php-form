<?php
     include ('conn.php');
    
    if(isset($_GET['id'])){ //To get the id if it is set
        $id = $_GET['id'];//To fetch data of the user
        $query = "select * from users where id='$id'"; //if id is there, "where" selects specific users which selects the users id (simply we will get the user whose id was passed in that page)
        $run = mysqli_query($conn, $query);
        $data = $run->fetch_assoc();//Getting the user's data interms of array 
        //$oldusername = $data['username']; //if user hasn't erased the old username to have it
   /* }else{ //if it is not set
        //to go back in the page of showing users
        //In php to go back to another page we use the function called header
        header('location: view_users.php');
    } */
        //Checking Whether button is pressed
        }else if (isset($_GET['submit'])){ //isset function checks if button is pressed or not, if pressed the superglobal variable get willtake all the entered information by the below codes 
        $id = $_GET['id2']; //so as not to get/fetch id as the first one (id)
        $oldusername = $_GET['oldusername'];
        $username = $_GET['username'];
        $full_name = $_GET['full_name'];
        $gender = $_GET['gender'];
        $dateofbirth = $_GET['dateofbirth'];
        $nationality = $_GET['nationality'];
        $phone_number = $_GET['phone_number'];
        $password = $_GET['password'];
        $error = ""; //error variable is empty string before validating or checkings
        //Validating all information which must be entered, (|| means or)
        
        //To ensure/validate username is not the same
        $query = "select * from users where username='$username'";
        $run = mysqli_query($conn, $query);
;        if (empty($username) || empty($full_name) || empty($gender) || empty($dateofbirth) || empty($nationality) || empty($phone_number) || empty($password)){
            $error = "Fill all Fields!"; //Generating error message if any of the above entries are not filled
        }else if(mysqli_num_rows($run) !=0) { //shows number of rows in the table after running the querys
        //Checking if user exists <update/edit page>
            if ($username != $oldusername ){ //if user has taken another username of another user* error appears
                $error = "User is Already Existing!"; 
             //If the user name is not as the old username (it will tell user exists already and runs the query to enter new data)
            }else{ //If all data are filled then we enter the information in our database as shown by below codes (statement of our update) 
            $query = "UPDATE users
                    SET 
                    Username='$username', 
                    full_name='$full_name', 
                    gender='$gender', 
                    dateofbirth='$dateofbirth', 
                    nationality='$nationality', 
                    phone_number='$phone_number', 
                    password='$password'
                    where 
                    id = '$id';"; //where means you are going to set to which user, $id= the id which was passed in the system, means to update to the user which is updating/being updated but not to the other users
                
            if(mysqli_query($conn, $query)){ //running the connection to the database conn and the query
                $message = "Data Succeffully Updated!";//If it was succefuly run and connected
                 header('location: view_users.php?message='.$message.''); //f we are done updating we go back to previous page
            }else{ //If data did not enter
                $error = "There was an error!";
            }
            
        }
            //If user does not exist it will tell to enter directly **but now we are just updating
        }else{ //If all data are filled then we enter the information in our database as shown by below codes 
            $query = "UPDATE INTO users
                    SET 
                    Username='$username', 
                    full_name='$full_name', 
                    gender='$gender', 
                    dateofbirth='$dateofbirth', 
                    nationality='$nationality', 
                    phone_number='$phone_number', 
                    password='$password'
                    where 
                    id = '$id';"; 
            if(mysqli_query($conn, $query)){ //running the connection to the database conn and the query
                $message = "Data Succeffully Updated!";//If it was succefuly run and connected
                 header('location: view_users.php?message='.$message.''); //f we are done updating we go back to previous page
            }else{ //If data did not enter
                $error = "There was an error!";
            }
        }
    }else{ //If button not pressed, to return us to the previous webpage
        header('location: view_users.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>UPDATE DATA INTO DATABASE</title>
        <a href="view_users.php">View Users</a> <!--Link to the php users page-->
        <style type="text/css">
            body{
                width: 850px;
                margin: auto; /*so as the form to be at the center*/
                background-color: skyblue;
            }
            
            /*Style to clear float so as they should not affect the labels in the form*/
            .form{
                clear: both; /*to clear left and right*/
            }
            .form input[type="text"], .form select, .form input[type="password"], .form input[type="date"]{ /*.form input .form select the ones inside our form*/
                /*[#] only the input with text/password/date type are the ones which will have the below styles */
                width: 100%; /*form fits to our selected body width*/
                padding: 10px;
                margin-bottom: 10px;
            }
            
            button{
                padding:10px;
                background: darkblue;
                border: 2px solid;
                cursor: pointer;
                color: white;
            }
            
            button:hover{
                opacity: 0.7;
            }
            
            /*styling div with classes of error and message in the lower php block(displaying if data has enteredor not)*/
            .error{
                width: 100%;
                background: red;
                color: white;
                padding: 15px;
            }
            .message{
                width: 100%;
                background: green;
                color: white;
                padding: 15px;
            }
            
            a{
                float: right;
                text-decoration: none;
                font-size: 20px;
                color: black;
                margin-top: 30px; /*To lower the word/link*/
                font-weight: 900;
            }
            a:hover{
                text-decoration: underline; /*So as when we hover the underline of text should appear again*/
            }
            
            h1{
                float: left;
            }
            
            label{
               font-weight: 800; 
            }
        
        </style>
    </head>
    
    <body>
        <center><h1>UPDATE DATA</h1></center>
        <form method="get" class="form"> <!--we are using get because we are just inserting normal data and not private ones -->
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $data['username']; ?>"><br>
            <label>Full Name</label>
            <input type="text" name="full_name" value="<?php echo $data['full_name']; ?>"><br>
            <label>Gender</label><br>
            Male: <input type="radio" name="gender" value="M" checked> <!--To pick male gender initially-->
            Female: <input type="radio" name="gender" value="F"><br><br>
            <label>Date of Birth</label>
            <input type="date" name="dateofbirth" value="<?php echo $data['dateofbirth']; ?>"><br>
            <label>Phone Number</label>
            <input type="text" name="phone_number" value="<?php echo $data['phone_number']; ?>"><br>
            <label>Nationality</label>
            <select name="nationality">
                <option><?php echo $data['nationality']; ?></option>
                <option>Tanzania</option>
                <option>Kenya</option>
                <option>Uganda</option>
            </select><br>
            <label>Password</label>
            <input type="password" name="password"><br>
            <input type="hidden" name="oldusername" value="<?php echo $data['username']; ?>"> <!--input is hidden, cant be seen, and data cant be changed-->
            <input type="hidden" name="id2" value="<?php echo $data['id']; ?>"> <!--we have an id which we have save in the form if we submit the id wont be lost in the form, id2 so as it should not be the same as the first id 'id'-->
            <center><button name="submit">UPDATE</button></center>
        </form>
        
        <!--To Show if data has entered or not, if not to display/show the error-->
        <?php
            if (!empty($error)){ //if the class in the div is in double quotes the echo shld have single quotes 
                echo '
                <div class="error">
                    <h2> 
                         ' . $error . ' 
                     </h2>
                </div>'; 
            } if(!empty($message)){
                echo '
                <div class="message">
                    <h2> 
                         ' . $message . ' 
                     </h2>
                </div>';
            }
        ?>
    </body>
</html>