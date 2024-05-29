<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_type = $_POST['form_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($form_type === 'signup') {
        $email = $_POST['email'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            header("Location: auth.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($form_type === 'login') {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                header("Location: index.html");
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username.";
        }
    }

    $conn->close();
}
?>
