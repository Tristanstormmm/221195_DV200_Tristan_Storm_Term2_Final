<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    $dentistId = $_POST['dentist_id'];
    $patientId = $_POST['patient_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Update the appointment details in the database
    $updateQuery = "UPDATE appointments SET dentist_id = $dentistId, patient_id = $patientId, date = '$date', time = '$time' WHERE id = $appointmentId";
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

    // Retrieve the list of dentists from the database
    $dentistsQuery = "SELECT * FROM dentists";
    $dentistsResult = mysqli_query($conn, $dentistsQuery);

    // Retrieve the list of patients from the database
    $patientsQuery = "SELECT * FROM patients";
    $patientsResult = mysqli_query($conn, $patientsQuery);
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
            <label>Dentist Name:</label>
            <select name="dentist_id">
                <?php while ($dentist = mysqli_fetch_assoc($dentistsResult)) { ?>
                    <option value="<?php echo $dentist['id']; ?>" <?php if ($dentist['id'] == $appointment['dentist_id']) echo 'selected'; ?>>
                        <?php echo $dentist['name']; ?>
                    </option>
                <?php } ?>
            </select>
            <label>Patient Name:</label>
            <select name="patient_id">
                <?php while ($patient = mysqli_fetch_assoc($patientsResult)) { ?>
                    <option value="<?php echo $patient['id']; ?>" <?php if ($patient['id'] == $appointment['patient_id']) echo 'selected'; ?>>
                        <?php echo $patient['name']; ?>
                    </option>
                <?php } ?>
            </select>
            <label>Date:</label>
            <input type="text" name="date" value="<?php echo $appointment['date']; ?>">
            <label>Time:</label>
            <input type="text" name="time" value="<?php echo $appointment['time']; ?>">
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
