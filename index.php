<?php //Linking php page connected with the database with our website page
    include ('conn.php');
    if (isset($_GET['submit'])){ //isset function checks if button is pressed or not, if pressed the superglobal variable get willtake all the entered information by the below codes 
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
            $error = "User is Already Existing!"; //simply the function prevents similar usernames 
        }else{ //If all data are filled then we enter the information in our database as shown by below codes 
            $query = "INSERT INTO users (Username, full_name, gender, dateofbirth, nationality, phone_number, password) VALUES (
                '$username',
                '$full_name',
                '$gender',
                '$dateofbirth',
                '$nationality',
                '$phone_number',
                '$password'
            );";
            if(mysqli_query($conn, $query)){ //running the connection to the database conn and the query
                $message = "Data Succeffully Inserted!";//If it was succefuly run and connected
            }else{ //If data did not enter
                $error = "There was an error!";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>INSERT DATA INTO DATABASE</title>
        <a href="view_users.php">View Users</a> <!--Link to the php users page-->
        <style type="text/css">
            body{
                width: 850px;
                margin: auto; /*so as the form to be at the center*/
                background-color: lightgray;
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
        <center><h1>REGISTER</h1></center>
        <form method="get" class="form"> <!--we are using get because we are just inserting normal data and not private ones -->
            <label>Username</label>
            <input type="text" name="username"><br>
            <label>Full Name</label>
            <input type="text" name="full_name"><br>
            <label>Gender</label><br>
            Male: <input type="radio" name="gender" value="M" checked> <!--To pick male gender initially-->
            Female: <input type="radio" name="gender" value="F"><br><br>
            <label>Date of Birth</label>
            <input type="date" name="dateofbirth"><br>
            <label>Phone Number</label>
            <input type="text" name="phone_number"><br>
            <label>Nationality</label>
            <select name="nationality">
                <option value="">--Select Nationality--</option>
                <option>Tanzania</option>
                <option>Kenya</option>
                <option>Uganda</option>
            </select><br>
            <label>Password</label>
            <input type="password" name="password"><br>
            <center><button name="submit">REGISTER</button></center>
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