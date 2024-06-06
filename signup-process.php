<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "homeworkhub"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $entered_name = $conn->real_escape_string($_POST['name']);
    $entered_email = $conn->real_escape_string($_POST['email']);
    $entered_password = $conn->real_escape_string($_POST['password']);
    $entered_school = $conn->real_escape_string($_POST['school']);
    $entered_course = $conn->real_escape_string($_POST['course']);
    $entered_year = $conn->real_escape_string($_POST['year']);
    $entered_section = $conn->real_escape_string($_POST['section']);


    $sql = "INSERT INTO users (name, email, password, school, course, year, section) VALUES ('$entered_name', '$entered_email', '$entered_password', '$entered_school', '$entered_course', '$entered_year', '$entered_section')";

    if ($conn->query($sql) === TRUE) {
        echo "Sign Up successful!";

        header("Location: ./login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;

        header("Location: ./signup.php");
        exit();
    }

    $conn->close();
}
?>
