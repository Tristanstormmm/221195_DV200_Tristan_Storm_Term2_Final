<?php
session_start();

if (!isset($_SESSION['receptionist_id'])) {
    // Redirect to the login page if the receptionist is not logged in
    header("Location: index.php");
    exit;
}

// Include the database connection
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $doctorName = $_POST['doctor_name'];
    $doctorOccupation = $_POST['doctor_occupation'];
    $patientName = $_POST['patient_name'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];

    // Insert the new appointment into the database
    $query = "INSERT INTO appointments (doctor_name, doctor_occupation, patient_name, appointment_date, appointment_time) VALUES ('$doctorName', '$doctorOccupation', '$patientName', '$appointmentDate', '$appointmentTime')";
    mysqli_query($conn, $query);

    // Redirect to the appointments page
    header("Location: appointments.php");
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Appointment</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Add New Appointment</h2>
        <form method="POST" action="">
            <label for="doctor_name">Doctor Name:</label>
            <input type="text" id="doctor_name" name="doctor_name" required>

            <label for="doctor_occupation">Doctor Occupation:</label>
            <input type="text" id="doctor_occupation" name="doctor_occupation" required>

            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" required>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>

            <label for="appointment_time">Appointment Time:</label>
            <input type="time" id="appointment_time" name="appointment_time" required>

            <input type="submit" value="Add Appointment">
        </form>
    </div>
</body>

</html>