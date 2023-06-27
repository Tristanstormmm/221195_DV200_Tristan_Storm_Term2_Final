<?php
session_start();

if (!isset($_SESSION['receptionist_id'])) {
    // Redirect to the login page if the receptionist is not logged in
    header("Location: index.php");
    exit;
}

if ($_SESSION['rank'] != 1) {
    // Redirect to the dashboard if the receptionist is not the head receptionist
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Include the database connection
    include 'db.php';

    $dentistId = $_GET['id'];

    // Delete the dentist from the database
    $query = "DELETE FROM dentists WHERE id = '$dentistId'";
    mysqli_query($conn, $query);

    // Ban the associated user account
    $query = "UPDATE users SET is_banned = 1 WHERE dentist_id = '$dentistId'";
    mysqli_query($conn, $query);

    mysqli_close($conn);
}

// Redirect to the dentists page
header("Location: dentists.php");
exit;