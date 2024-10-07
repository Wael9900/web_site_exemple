<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
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
    <h1>Login</h1>
    
    <?php


$servername = "localhost";
$username = "root";
$password = ""; 
$database = "projet_db"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

 
    $email = mysqli_real_escape_string($conn, $email);

   
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            echo "Login successful!";
            
            echo '<script>localStorage.setItem("isLoggedIn", true);</script>';
        
            echo '<script>window.location.href = "../projet dev web 1/index.html  #contact";</script>';

        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}
?>


<!-- Login form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Email: <input type="text" name="email"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" name="login" value="Login">
    <button type="reset">Reinitialiser</button>
</form>
    
    <!-- Button  return   main page -->
    <button class="return-button"><a href = '..\projet dev web 1\index.html  #contact'> Return</a></button>
</body>
</html>




