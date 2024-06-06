<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "homeworkhub"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $entered_username = $_POST['email'];
    $entered_password = $_POST['password'];


    $sql = "SELECT name FROM users WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $entered_username, $entered_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $full_name = $row['name'];


        $_SESSION['name'] = $full_name;

        $_SESSION['message'] = "Login successful!";

        header("Location: ./index.html"); 
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password";

        header("Location: ./login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>