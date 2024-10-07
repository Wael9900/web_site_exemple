<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
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

            input[type="text"] {
            width: 300px; 
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
    <h1>Sign Up</h1>
    
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
        $password = mysqli_real_escape_string($conn, $password);

         
        $check = "SELECT * FROM user WHERE email='$email'";
        $check_rslt = $conn->query($check);
        
        if ($check_rslt->num_rows > 0) {
            echo "Email already exists! Please use a different email.";
        } else {
             
            $sql = "INSERT INTO user (email, password) VALUES ('$email', '$password')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Signup successful!";
                echo '<script>window.location.href = "http://localhost/login.php";</script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
?>


    <!-- Signup form -->
    <form onsubmit="return testEmail()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Email: <input type="text" id="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.fr|outlook\.fr)$" placeholder="end with (@gmail.com/@yahoo.fr/@outlook.fr)" required><br>
        Password: <input type="password" id="password" name="password" minlength="8" placeholder="Minimum 8 caractères" required><br>
        <input type="submit" name="signup" value="Sign Up">
        <button type="reset">Reinitialiser</button>
    </form>

    <!-- Button  return to main page -->
    <button class="return-button"><a href = '..\projet dev web 1\index.html  #contact'> Return</a></button>

    <script>
        function testEmail() {
            var emailInput = document.getElementById("email");
            var email = emailInput.value.trim();
            
            var control = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.fr|outlook\.fr)$/;
            
            if (!control.test(email)) {
                alert("Veuillez entrer une adresse email valide avec le format requis !");
                return false;
            }
        }
    </script>
</body>
</html>
