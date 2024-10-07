<?php
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST["name"];
    $tel = $_POST["tel"];
    $birthdate = $_POST["birthdate"];
    $sexe = $_POST["sexe"];
    $type = $_POST["type"];

     
    $servername = "localhost";
    $username = "root";
    $password = "";  
    $dbname = "projet_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

     
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     
    $sql = "INSERT INTO recruitment (name, tel, birthdate, sexe, type) 
            VALUES ('$name', '$tel', '$birthdate', '$sexe', '$type')";

    if ($conn->query($sql) === TRUE) {
        
        echo '<script>window.location.href = "../projet dev web 1/index.html #contact";</script>';
        echo 'alert("Formulaire envoye!");</script>';
        exit;  
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
