<?php
session_start();

// Include the database connection
include 'db.php';

// Check if the receptionist is logged in
if (!isset($_SESSION['receptionist_id'])) {
    // If not logged in, redirect to the login page
    header("Location: index.php");
    exit;
}

// Handle form submission for updating the appointment details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated appointment information from the form
    $appointmentId = $_POST['appointment_id'];
    $doctorName = $_POST['doctor_name'];
    $patientName = $_POST['patient_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Update the appointment details in the database
    $updateQuery = "UPDATE appointments SET doctor_name = '$doctorName', patient_name = '$patientName', date = '$date', time = '$time' WHERE id = $appointmentId";
    mysqli_query($conn, $updateQuery);

    // Redirect back to the dashboard
    header("Location: dashboard.php");
    exit;
}

// Retrieve the appointment ID from the URL parameter
if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Retrieve the appointment details from the database
    $query = "SELECT * FROM appointments WHERE id = $appointmentId";
    $result = mysqli_query($conn, $query);
    $appointment = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Appointment</h2>
        <form method="POST" action="">
            <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
            <label>Doctor Name:</label>
            <input type="text" name="doctor_name" value="<?php echo $appointment['doctor_name']; ?>">
            <label>Patient Name:</label>
            <input type="text" name="patient_name" value="<?php echo $appointment['patient_name']; ?>">
            <label>Date:</label>
            <input type="text" name="date" value="<?php echo $appointment['date']; ?>">
            <label>Time:</label>
            <input type="text" name="time" value="<?php echo $appointment['time']; ?>">
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
