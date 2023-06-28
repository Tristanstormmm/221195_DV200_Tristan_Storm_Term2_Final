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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Include the database connection
    include 'db.php';

    $dentistId = $_GET['id'];

    // Retrieve the dentist's information from the database
    $query = "SELECT * FROM dentists WHERE id = '$dentistId'";
    $result = mysqli_query($conn, $query);
    $dentist = mysqli_fetch_assoc($result);

    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';

    $dentistId = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $occupation = $_POST['occupation'];

    // Update the dentist's information in the database
    $query = "UPDATE dentists SET name = '$name', surname = '$surname', gender = '$gender', age = '$age', email = '$email', phone = '$phone', occupation = '$occupation' WHERE id = '$dentistId'";
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
    <title>Edit Dentist</title>
    <!-- Include necessary CSS stylesheets -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Edit Dentist</h2>
        <form action="edit_dentist.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $dentist['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $dentist['name']; ?>"><br>
            <label for="surname">Surname:</label>
            <input type="text" name="surname" value="<?php echo $dentist['surname']; ?>"><br>
            <label for="gender">Gender:</label>
            <input type="text" name="gender" value="<?php echo $dentist['gender']; ?>"><br>
            <label for="age">Age:</label>
            <input type="text" name="age" value="<?php echo $dentist['age']; ?>"><br>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $dentist['email']; ?>"><br>
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" value="<?php echo $dentist['phone']; ?>"><br>
            <label for="occupation">Occupation:</label>
            <input type="text" name="occupation" value="<?php echo $dentist['occupation']; ?>"><br>
            <input type="submit" value="Save">
        </form>
    </div>
</body>

</html>