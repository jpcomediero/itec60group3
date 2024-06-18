<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homeworkhub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        session_start();
        $_SESSION['user'] = $user;
        header('Location: index.html');
        exit;
    } else {
        echo 'Invalid email or password. <a href="index.html">Try again</a>';
    }

    $stmt->close();
}

$conn->close();
?>
