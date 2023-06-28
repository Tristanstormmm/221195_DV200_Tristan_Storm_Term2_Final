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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection
    include 'db.php';

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $medicalAidNumber = $_POST['medical_aid_number'];
    $email = $_POST['email'];

    // Insert the new patient into the database
    $query = "INSERT INTO patients (name, surname, gender, age, medical_aid_number, email) VALUES ('$name', '$surname', '$gender', '$age', '$medicalAidNumber', '$email')";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    // Redirect to the patients page
    header("Location: patient.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Patient</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Add Patient</h2>
        <form action="add_patient.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name"><br>
            <label for="surname">Surname:</label>
            <input type="text" name="surname"><br>
            <label for="gender">Gender:</label>
            <input type="text" name="gender"><br>
            <label for="age">Age:</label>
            <input type="text" name="age"><br>
            <label for="medical_aid_number">Medical Aid Number:</label>
            <input type="text" name="medical_aid_number"><br>
            <label for="email">Email:</label>
            <input type="text" name="email"><br>
            <label for="password">Password:</label>
            <input type="password" name="password"><br>
            <input type="submit" value="Add Patient">
        </form>
    </div>
</body>

</html>