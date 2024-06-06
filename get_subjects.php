<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id, name FROM subjects WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$subjects = [];
while ($row = $result->fetch_assoc()) {
    $subjects[] = $row;
}

foreach ($subjects as &$subject) {
    $subjectId = $subject['id'];
    $stmt = $conn->prepare("SELECT id, title, description, deadline, type FROM tasks WHERE user_id = ? AND subject_id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $user_id, $subjectId);
    $stmt->execute();
    $result = $stmt->get_result();
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
    $subject['tasks'] = $tasks;
}

echo json_encode(['subjects' => $subjects]);
?>
