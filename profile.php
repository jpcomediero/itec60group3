<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Retrieve user data from session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="./assets/homeworkhub.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/profile.css">
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            margin-top: 20px;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 100px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-heading h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .profile-info {
            line-height: 1.8;
            color: black;
        }

        .profile-info p {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .profile-info label {
            font-weight: bold;
            width: 100px; /* Adjust the width as needed */
        }
    
</style>
<body>
    <header>
        <h1>HomeworkHub</h1>
        <nav>
            <ul class="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a href="tasks.php">Tasks</a></li>
                <li><a href="devs.html">About Us</a></li>
                <li class="dropdown">
                    <a href="profile.php" class="dropbtn">Profile</a>
                    <div class="dropdown-content">
                        <a href="logout.php">Log out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
        <div class="profile-heading">
            <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?></h2>
        </div>
        <div class="profile-info">
            <p><label>Email:</label> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><label>Name:</label> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><label>Course:</label> <?php echo htmlspecialchars($user['course']); ?></p>
            <p><label>Year:</label> <?php echo htmlspecialchars($user['year']); ?></p>
            <p><label>Section:</label> <?php echo htmlspecialchars($user['section']); ?></p>
            <p><label>School:</label> <?php echo htmlspecialchars($user['school']); ?></p>
        </div>
    </div>
    </main>
</body>
</html>
