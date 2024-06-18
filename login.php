<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
	<link rel="icon" href=".\assets\homeworkhub.png" type="image/x-icon">
    <link rel="stylesheet" href=".\css\auth.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>HomeworkHub</h1>
    </header>
    <main>
        <div class="container">
			<img src=".\assets\homeworkhub.png" alt="Image 1">
            <h2>Log in</h2>
            <form action="login-process.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Log in</button>
				<p id="toggle-message">Don't have an account? <a href="signup.php" id="toggle-link">Sign up</a></p>
            </form>
        </div>
    </main>
</body>
</html>
