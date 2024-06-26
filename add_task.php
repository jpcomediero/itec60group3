<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.html'); // Redirect to login if not logged in
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homeworkhub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user']['id'];
    $subject = $conn->real_escape_string($_POST['subject']);
    $task = $conn->real_escape_string($_POST['task']);
    $deadline = $conn->real_escape_string($_POST['deadline']);

    // Insert task into database
    $sql = "INSERT INTO tasks (user_id, subject, task, deadline) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $subject, $task, $deadline);

    if ($stmt->execute() === TRUE) {
        echo "New task added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

header('Location: tasks.php'); // Redirect back to main page
exit;
?>
