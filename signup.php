<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="icon" href=".\assets\homeworkhub.png" type="image/x-icon">
    <link rel="stylesheet" href=".\css\signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="container">
            <div class="signup-form">
                <h2>Sign up</h2>
                <form action="signup-process.php" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="school">School:</label>
                        <input type="text" id="school" name="school" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Course:</label>
                        <input type="text" id="course" name="course" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="text" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="section">Section:</label>
                        <input type="text" id="section" name="section" required>
                    </div>
                    <button type="submit">Sign up</button>
                    <br>
                    <br>
                </form>
            </div>
            <div class="signup-image">
                <img src=".\assets\homeworkhub.png" alt="Website Image">
				<h1>HomeworkHub</h1>
				<p>Already have an account? <a href="login.php">Log in</a></p>
            </div>
        </div>
    </main>
    <script src=".\js\signup.js"></script>
</body>
</html>
