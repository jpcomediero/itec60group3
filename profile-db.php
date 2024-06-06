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

    $entered_medication_name = $conn->real_escape_string($_POST['medication_name']);
    $entered_dosage = $conn->real_escape_string($_POST['dosage']);
    $entered_instructions = $conn->real_escape_string($_POST['instructions']);
    $entered_prescription_start_date = $conn->real_escape_string($_POST['prescription_start_date']);
    $entered_prescription_end_date = $conn->real_escape_string($_POST['prescription_end_date']);

    $sql = "INSERT INTO medication_table (medication_name, dosage, instructions, prescription_start_date, prescription_end_date)
        VALUES ('$entered_medication_name', '$entered_dosage', '$entered_instructions', '$entered_prescription_start_date', '$entered_prescription_end_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $data = [];

    $sql = "SELECT medication_id, medication_name, dosage, instructions, prescription_start_date, prescription_end_date FROM medication_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo "<p>No data found</p>";
    }

    $conn->close();
}
?>
