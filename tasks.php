<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php'); 
    exit;
}

$user_id = $_SESSION['user']['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homeworkhub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
}

$stmt->close();
$conn->close();

file_put_contents('debug_log.txt', "Fetched tasks: " . print_r($tasks, true) . "\n", FILE_APPEND);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
	<link rel="icon" href=".\assets\homeworkhub.png" type="image/x-icon">
    <link rel="stylesheet" href=".\css\tasks.css">

    <link rel="stylesheet" href=".\css\chat.css">
    <link rel="stylesheet" href=".\css\home.css">
</head>

<style>

body {
    font-family: Arial, sans-serif;
    background-color: #121212;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}


.container {
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    width: 900px;
}

.form-container {
    margin-bottom: 20px;
}

.form-container h2 {
    margin-bottom: 10px;
    color: #333;
}

.form-container form {
    display: flex;
    flex-direction: column;
}

.form-container input[type="text"],
.form-container input[type="date"] {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-container button {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.form-container button:hover {
    background-color: #0056b3;
}

/* To-Do Container */
.todo-container {
    margin-top: 20px;
}

.todo-container h2 {
    color: #333;
}

.todo-container ul {
    list-style-type: none;
    padding: 0;
}

.todo-container li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f9f9f9;
}

.todo-container li span {
    flex-grow: 1;
    color: #333;
}

.todo-container li form {
    display: flex;
    align-items: center;
}

.todo-container li input[type="checkbox"] {
    margin-right: 10px;
}

.todo-container button {
    padding: 10px;
    background-color: #dc3545;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.todo-container button:hover {
    background-color: #c82333;
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
        <div class="form-container">
            <h2>Add New Task</h2>
            <form action="add_task.php" method="post">
                <input type="text" name="subject" placeholder="Subject" required>
                <input type="text" name="task" placeholder="Task" required>
                <input type="date" name="deadline" required>
                <button type="submit">Add Task</button>
            </form>
        </div>
        <div class="todo-container">
            <h2>My To-Do List</h2>
            <ul>
                <?php if (empty($tasks)) : ?>
                    <li>No tasks found.</li>
                <?php else : ?>
                    <?php foreach ($tasks as $task) : ?>
                        <li>
                            <form action="update_task.php" method="post">
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                <input type="checkbox" name="status" value="1" <?= $task['status'] == 1 ? 'checked' : '' ?> onchange="this.form.submit()">
                                <span><?= htmlspecialchars($task['subject']) ?> - <?= htmlspecialchars($task['task']) ?> (Deadline: <?= htmlspecialchars($task['deadline']) ?>)</span>
                            </form>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <form action="clear_completed_tasks.php" method="post">
                <button type="submit">Clear Completed</button>
            </form>
        </div>
    </div>

    
    </main>
    <script src=".\js\tasks.js"></script>
</body>
</html>
