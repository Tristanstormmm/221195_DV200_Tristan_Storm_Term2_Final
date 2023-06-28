<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $occupation = $_POST['occupation'];
    $profile_img = $_POST['profile_img'];

    // Insert the new dentist into the database
    $query = "INSERT INTO dentists (name, surname, gender, age, email, phone, occupation, profile_img) VALUES ('$name', '$surname', '$gender', '$age', '$email', '$phone', '$occupation', '$profile_img')";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    // Redirect to the dentists page
    header("Location: dentist.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Dentist</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Add Dentist</h2>
        <form action="add_dentist.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name"><br>
            <label for="surname">Surname:</label>
            <input type="text" name="surname"><br>
            <label for="gender">Gender:</label>
            <input type="text" name="gender"><br>
            <label for="age">Age:</label>
            <input type="text" name="age"><br>
            <label for="email">Email:</label>
            <input type="text" name="email"><br>
            <label for="phone">Phone:</label>
            <input type="text" name="phone"><br>
            <label for="occupation">Occupation:</label>
            <input type="text" name="occupation"><br>
            <label for="profile_img">Profile Image:</label>
            <input type="text" name="profile_img"><br>
            <input type="submit" value="Add Dentist">
        </form>
    </div>
    
</body>

</html>