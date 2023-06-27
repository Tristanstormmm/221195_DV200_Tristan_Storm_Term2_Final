<?php
session_start();

if (!isset($_SESSION['receptionist_id'])) {
    // Redirect to the login page if the receptionist is not logged in
    header("Location: index.php");
    exit;
}

// Include the database connection
include 'db.php';

// Get the upcoming appointments from the database
$query = "SELECT * FROM appointments ORDER BY appointment_date ASC, appointment_time ASC";
$result = mysqli_query($conn, $query);

// Group appointments by date
$appointmentsByDate = array();
while ($row = mysqli_fetch_assoc($result)) {
    $date = date("Y-m-d", strtotime($row['appointment_date']));
    $appointmentsByDate[$date][] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Appointments</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Upcoming Appointments</h2>
        <?php foreach ($appointmentsByDate as $date => $appointments) { ?>
            <h3>
                <?php echo date("F j, Y", strtotime($date)); ?>
            </h3>
            <?php foreach ($appointments as $appointment) { ?>
                <div class="appointment">
                    <p><strong>Doctor:</strong>
                        <?php echo $appointment['doctor_name']; ?>
                    </p>
                    <p><strong>Occupation:</strong>
                        <?php echo $appointment['doctor_occupation']; ?>
                    </p>
                    <p><strong>Patient:</strong>
                        <?php echo $appointment['patient_name']; ?>
                    </p>
                    <p><strong>Date:</strong>
                        <?php echo date("F j, Y", strtotime($appointment['appointment_date'])); ?>
                    </p>
                    <p><strong>Time:</strong>
                        <?php echo date("h:i A", strtotime($appointment['appointment_time'])); ?>
                    </p>
                    <a href="delete_appointment.php?id=<?php echo $appointment['id']; ?>">Delete</a>
                </div>
            <?php } ?>
        <?php } ?>
        <a href="add_appointment.php">Add New Appointment</a>
    </div>
</body>

</html>