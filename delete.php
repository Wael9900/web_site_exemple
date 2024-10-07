<!DOCTYPE html>
<html>
<head>
    <title>Delete Account Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        
        form {
            margin-top: 50px;
        }
        
        input{
            margin:5px;
        }
        
        button,
            input[type="button"],
            input[type="reset"],
            input[type="submit"] {
                padding: 10px 20px;
                margin: 10px 25px;
                background-color: #333;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 5px;
                font-size: 1rem;
            }

 
            button:hover,
            input[type="button"]:hover,
            input[type="reset"]:hover,
            input[type="submit"]:hover {
                background-color: #555;
            }
        .return-button a {
            color: black;  
            text-decoration: none;  
            color:white;
            font-size: 1.1em;
        }
        .return-button {
            padding: 4px 8px; 
        }
    </style>
</head>
<body>
    <h2>Delete Account</h2>
    
    <?php
 
$servername = "localhost";
$username = "root";
$password = "";  
$database = "projet_db";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

     
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
          
            $user_id = $row['id'];
            $sql_delete = "DELETE FROM user WHERE id='$user_id'";
            if ($conn->query($sql_delete) === TRUE) {
                echo "User deleted successfully!";
                echo '<script>localStorage.setItem("isLoggedIn", false);</script>';
                echo '<script>alert("account deleted");</script>';
                echo '<script>window.location.href = "../projet dev web 1/index.html  #contact";</script>';

            } else {
                echo "Error deleting user: " . $conn->error;
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "User not found.";
    }
}
?>

<!-- Delete user form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Email: <input type="text" name="email" id="email"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="delete_user" value="Delete User">
    <button type="reset">Reinitialiser</button>
</form>
    
    <!-- Button      return to main page -->
    <button class="return-button"><a href = '..\projet dev web 1\index.html  #contact'> Return</a></button>
    
</body>
</html>




