<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href=".\assets\homeworkhub.png" type="image/x-icon">
    <link rel="stylesheet" href=".\css\profile.css">
</head>
<body>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "homeworkhub";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $data = [];
    
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo "<p>No data found</p>";
    }
    $conn->close();
    
    ?>


    <header>
        <h1>HomeworkHub</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="tasks.html">Tasks</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Profile</h2>
        <div class="profile-info">
            <div class="profile-image">
                <img src=".\assets\profile.png" alt="Profile Picture">
            </div>

        <?php
        foreach ($data as $row) {
            echo "Name: " . $row['name'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
            echo "School: " . $row['school'] . "<br>";
            echo "Course: " . $row['course'] . "<br>";
            echo "Year & Section: " . $row['year'] . "-" . $row['section'] . "<br>";

        }
        ?>
        </div>
    </main>
</body>
</html>

