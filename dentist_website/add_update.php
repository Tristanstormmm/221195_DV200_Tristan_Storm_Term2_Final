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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection
    include 'db.php';

    $update = $_POST['update'];

    // Insert the update into the database
    $query = "INSERT INTO updates (update_text) VALUES ('$update')";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    // Redirect to the dashboard
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Update</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Add Update</h2>
        <form action="add_update.php" method="POST">
            <label for="update">Update:</label>
            <textarea name="update" rows="5" cols="30"></textarea><br>
            <input type="submit" value="Add Update">
        </form>
    </div>
</body>

</html>