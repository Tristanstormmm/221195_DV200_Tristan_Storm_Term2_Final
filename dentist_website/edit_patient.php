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

    // Retrieve the patient's information from the database
    $query = "SELECT * FROM patients WHERE id = '$patientId'";
    $result = mysqli_query($conn, $query);
    $patient = mysqli_fetch_assoc($result);

    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';

    $patientId = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $medicalAidNumber = $_POST['medical_aid_number'];

    // Update the patient's information in the database
    $query = "UPDATE patients SET name = '$name', surname = '$surname', gender = '$gender', age = '$age', email = '$email', medical_aid_number = '$medicalAidNumber' WHERE id = '$patientId'";
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
    <title>Edit Patient</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Edit Patient</h2>
        <form action="edit_patient.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $patient['name']; ?>"><br>
            <label for="surname">Surname:</label>
            <input type="text" name="surname" value="<?php echo $patient['surname']; ?>"><br>
            <label for="gender">Gender:</label>
            <input type="text" name="gender" value="<?php echo $patient['gender']; ?>"><br>
            <label for="age">Age:</label>
            <input type="text" name="age" value="<?php echo $patient['age']; ?>"><br>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $patient['email']; ?>"><br>
            <label for="medical_aid_number">Medical Aid Number:</label>
            <input type="text" name="medical_aid_number" value="<?php echo $patient['medical_aid_number']; ?>"><br>
            <input type="submit" value="Save">
        </form>
    </div>
</body>

</html>