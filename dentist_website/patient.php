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

// Include the database connection
include 'db.php';

// Get the patients from the database
$query = "SELECT * FROM patients";
$result = mysqli_query($conn, $query);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Patients</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        body {
            background-color: #F7F7F7;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
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

        .patient {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: black;
        }

        .patient img {
            height: 100px;
            width: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .patient p {
            margin: 0;
            color: #AAAAAA;
        }

        /* Style delete and edit links */
        .patient .links {
            margin-left: auto;
        }

        .patient .links a {
            display: inline-block;
            padding: 5px 10px;
            margin-left: 10px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: medium;
        }

        .patient .links a.delete-link {
            background-color: #FF0000;
        }

        .patient .links a.edit-link {
            background-color: #089FA6;
        }

        /* Style add patient link */
        .add-patient-link {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #089FA6;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: medium;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar">
                    <div class="logo">
                        <img src="images/logo.png" style="margin-top: 20px;" height="60px">
                    </div>
                    <ul class="nav">
                        <a href="dashboard.php"
                            style="text-decoration: none; color: #AAAAAA; font-weight: 500;">Dashboard</a>
                        <a href="dentist.php"
                            style="text-decoration: none; color: #AAAAAA; font-weight: 500;">Dentists</a>
                        <a href="patient.php"
                            style="text-decoration: none; color: #089FA6; font-weight: 500; box-shadow: inset -10px 0px 0px #089FA6; color: #089FA6;">Patients</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="content">
                    <h2>Patients</h2>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="patient">
                            <?php if (!empty($row['profile_img'])) { ?>
                                <img src="profile_img/<?php echo $row['profile_img']; ?>" alt="Profile Image">
                            <?php } else { ?>
                                <img src="default_profile_img.jpg" alt="Default Profile Image">
                            <?php } ?>
                            <div>
                                <p style="color: black"><strong>Name:</strong>
                                    <?php echo $row['name']; ?>
                                </p>
                                <p style="color: black"><strong>Surname:</strong>
                                    <?php echo $row['surname']; ?>
                                </p>
                                <p style="color: black"><strong>Gender:</strong>
                                    <?php echo $row['gender']; ?>
                                </p>
                                <p style="color: black"><strong>Age:</strong>
                                    <?php echo $row['age']; ?>
                                </p>
                                <p style="color: black"><strong>Email:</strong>
                                    <?php echo $row['email']; ?>
                                </p>
                                <p style="color: black"><strong>Medical Aid Number:</strong>
                                    <?php echo $row['medical_aid_number']; ?>
                                </p>
                            </div>
                            <?php if ($_SESSION['rank'] != 1) { ?>
                                <div class="links">
                                    <a href="delete_patient.php?id=<?php echo $row['id']; ?>" class="delete-link" style="font-size: 16px; display: inline-block; padding: 10px 20px; margin-top: 20px; color: white; border-radius: 5px; text-decoration: none; font-weight: medium;">Delete</a>
                                    <a href="edit_patient.php?id=<?php echo $row['id']; ?>" class="edit-link" style="font-size: 16px; display: inline-block; padding: 10px 20px; margin-top: 20px; color: white; border-radius: 5px; text-decoration: none; font-weight: medium;">Edit</a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['rank'] != 1) { ?>
                        <a style="font-size: 16px; display: inline-block; padding: 10px 20px; margin-top: 20px; color: white; border-radius: 5px; text-decoration: none; font-weight: medium;" href="add_patient.php" class="add-patient-link">Add New Patient</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>