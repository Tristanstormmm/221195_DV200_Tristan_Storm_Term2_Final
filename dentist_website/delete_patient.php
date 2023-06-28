<?php
session_start();

if (!isset($_SESSION['receptionist_id'])) {
    // Redirect to the login page if the receptionist is not logged in
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Include the database connection
    include 'db.php';

    $patientId = $_GET['id'];

    // Delete the patient from the database
    $query = "DELETE FROM patients WHERE id = '$patientId'";
    mysqli_query($conn, $query);

    mysqli_close($conn);
}

// Redirect to the patients page
header("Location: patient.php");
exit;