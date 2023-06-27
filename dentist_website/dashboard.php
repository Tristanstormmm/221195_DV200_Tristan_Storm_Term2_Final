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

// Retrieve the receptionist details from the database
$receptionistId = $_SESSION['receptionist_id'];
$query = "SELECT * FROM receptionists WHERE id = $receptionistId";
$result = mysqli_query($conn, $query);
$receptionist = mysqli_fetch_assoc($result);

// Handle form submission for updating the receptionist profile
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    // Retrieve the updated profile information from the form
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $profile_img = $_POST['profile_img'];

    // Redirect back to the dashboard
    header("Location: dashboard.php");
    exit;
}

// Handle form submission for adding a new appointment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_appointment'])) {
    // Retrieve the appointment details from the form
    $dentistId = $_POST['dentist_id'];
    $patientId = $_POST['patient_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Insert the new appointment into the database with the receptionist ID
    $insertQuery = "INSERT INTO appointments (dentist_id, patient_id, date, time, receptionist_id) VALUES ($dentistId, $patientId, '$date', '$time', $receptionistId)";
    mysqli_query($conn, $insertQuery);

    // Redirect back to the dashboard
    header("Location: dashboard.php");
    exit;
}

// Retrieve the list of registered dentists and patients from the database
$dentistsQuery = "SELECT * FROM dentists";
$dentistsResult = mysqli_query($conn, $dentistsQuery);

$patientsQuery = "SELECT * FROM patients";
$patientsResult = mysqli_query($conn, $patientsQuery);


// Retrieve the upcoming appointments for the receptionist with the corresponding dentist and patient names
$appointmentsQuery = "SELECT a.*, d.name AS dentist_name, d.surname AS dentist_surname, p.name AS patient_name, p.surname AS patient_surname
                     FROM appointments a
                     JOIN dentists d ON a.dentist_id = d.id
                     JOIN patients p ON a.patient_id = p.id
                     WHERE a.receptionist_id = $receptionistId
                     ORDER BY a.date ASC";
$appointmentsResult = mysqli_query($conn, $appointmentsQuery);
$numAppointments = mysqli_num_rows($appointmentsResult);
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>

<head>
    <title>Receptionist Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            background-color: #F7F7F7;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            background-color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 16.66667%;
        }

        .logo {
            text-align: center;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav {
            margin-top: 30px;
        }

        .nav a {
            display: block;
            padding: 10px 20px;
            margin-left: 10px;
            margin-top: 20px;
            color: black;
        }

        .nav a:hover {
            color: #089FA6;
            text-decoration: none;
            background-color: rgb(255, 255, 255);
        }

        .content {
            margin-left: 16.66667%;
            padding: 20px;
        }

        .profile-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-card img {
            height: 100px;
            width: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-card h3 {
            margin: 0;
        }

        .profile-card p {
            margin: 0;
            color: #AAAAAA;
        }

        .appointments {
            margin-top: 20px;
        }

        .appointment-block {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            display: inline-block;
            width: 24%;
            margin-right: 2%;
            vertical-align: top;
        }

        .add-appointment .appointment-block {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            display: inline-block;
            width: 24%;
            vertical-align: top;
            margin-right: 2%;
        }

        .add-appointment .appointment-block form {
            display: flex;
            flex-direction: column;
        }

        .add-appointment .appointment-block select,
        .add-appointment .appointment-block input[type="date"],
        .add-appointment .appointment-block input[type="time"] {
            margin-bottom: 10px;
        }

        .add-appointment .appointment-block button {
            background-color: #089FA6;
            color: white;
            border: none;
            width: 100%;
            height: 30px;
            border-radius: 5px;
        }

        .divider {
            height: 1px;
            background-color: lightgray;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar">
                    <div class="logo">
                        <img src="images/logo.png" style="margin-top: 20px ;" height="60px">
                    </div>
                    <ul class="nav">
                        <a href="dashboard.php"
                            style="text-decoration: none; color: #089FA6; font-weight: 500; box-shadow: inset -10px 0px 0px #089FA6; color: #089FA6;">Dashboard</a>
                        <a href="dentist.php"
                            style="text-decoration: none; color: #AAAAAA; font-weight: 500;">Dentists</a>
                        <a href="patient.php"
                            style="text-decoration: none; color: #AAAAAA; font-weight: 500;">Patients</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="content">
                    <h2>Welcome,
                        <?php echo $receptionist['name']; ?>!
                    </h2>
                    <div class="profile-card">
                        <?php
                        $profile_img = $receptionist['profile_img'];
                        if ($profile_img) {
                            echo '<img src="profile_img/' . $profile_img . '" alt="Profile Image">';
                        } else {
                            echo '<img src="images/default-profile-img.jpg" alt="Default Profile Image">';
                        }
                        ?>
                        <?php if (isset($_GET['edit'])): ?>
                        <?php else: ?>
                            <div>
                                <h3>
                                    <?php echo $receptionist['name'] . ' ' . $receptionist['surname']; ?>
                                </h3>
                                <p>
                                    <?php echo $receptionist['role']; ?>
                                </p>
                            </div>
                            <div style="margin-left: auto;">
                                <a href="index.php">
                                    <button
                                        style="background-color: red; color: white; border: 1px solid red; width: 100px; height: 30px; border-radius: 5px; margin-right: 30px;">Logout</button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="appointments">
                        <h2>Upcoming Appointments</h2>
                        <div class="divider"></div>
                        <?php if ($numAppointments > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($appointmentsResult)) { ?>
                                <div class="appointment-block"
                                    style="padding-left: 40px; padding-right: 40px; padding-bottom: 40px;">
                                    <h3>
                                        <?php echo 'Dr. ' . $row['dentist_name'] . ' ' . $row['dentist_surname']; ?>
                                    </h3>
                                    <p>Patient:
                                        <?php echo $row['patient_name'] . ' ' . $row['patient_surname']; ?>
                                    </p>
                                    <p>Date:
                                        <?php echo $row['date']; ?>
                                    </p>
                                    <p>Time:
                                        <?php echo $row['time']; ?>
                                    </p>
                                    <a href="edit_appointment.php?id=<?php echo $row['id']; ?>"><button>Edit</button></a>
                                    <a style="margin-left: 60px;"
                                        href="delete_appointment.php?id=<?php echo $row['id']; ?>"><button>Delete</button></a>
                                </div>
                                <?php if ($numAppointments % 4 === 0) { ?>
                                    <div style="clear: both;"></div>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <p>No upcoming appointments found.</p>
                        <?php } ?>
                        <div class="add-appointment">
                            <div class="appointment-block"
                                style="padding-left: 40px; padding-right: 40px; padding-bottom: 40px; padding-top: 38px;">
                                <form method="POST" action="">
                                    <select name="dentist_id" required>
                                        <option value="" disabled selected>Select Dentist</option>
                                        <?php while ($dentist = mysqli_fetch_assoc($dentistsResult)) { ?>
                                            <option value="<?php echo $dentist['id']; ?>"><?php echo $dentist['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <select name="patient_id" required>
                                        <option value="" disabled selected>Select Patient</option>
                                        <?php while ($patient = mysqli_fetch_assoc($patientsResult)) { ?>
                                            <option value="<?php echo $patient['id']; ?>"><?php echo $patient['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <input type="date" name="date" required>
                                    <input type="time" name="time" required>
                                    <button type="submit" name="add_appointment">Add Appointment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>