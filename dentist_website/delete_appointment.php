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

// Retrieve the appointment ID from the URL parameter
if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Delete the appointment from the database
    $deleteQuery = "DELETE FROM appointments WHERE id = $appointmentId";
    mysqli_query($conn, $deleteQuery);

    // Redirect back to the dashboard
    header("Location: dashboard.php");
    exit;
}
?>
