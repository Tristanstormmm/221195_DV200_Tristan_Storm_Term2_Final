<?php
session_start();
if (isset($_SESSION['login_name'])) {
    $login_name = $_SESSION['login_name'];
} else {
    // Redirect the user back to the login page if the session variable is not set
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #F7F7F7;
        }

        .sidebar {
            background-color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 16.66667%;
            /* col-md-2 occupies 16.66667% of the container */
        }

        .sidebar-logo {
            text-align: center;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sidebar-nav {
            margin-top: 30px;
        }

        .sidebar-nav a {
            display: block;
            padding: 10px 20px;
            margin-left: 10px;
            margin-top: 20px;
            color: black;
        }

        .sidebar-nav a:hover {
            color: #089FA6;
            text-decoration: none;
            background-color: rgb(255, 255, 255);
        }

        .content {
            margin-left: 16.66667%;
            /* col-md-2 width */
            padding: 20px;
        }

        .welcome-text {
            margin-bottom: 20px;
            margin-top: 100px;
            /* Add spacing equal to the height of the logo */
        }

        .block {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
        }

        .appointment-details {
            display: flex;
            flex-direction: column;
        }

        .doctor-info {
            display: flex;
            align-items: center;
        }

        .doctor-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            /* Add background image or styling for the doctor's image */
        }

        .doctor-name-occupation {
            display: flex;
            flex-direction: column;
            margin-left: 10px;
        }

        .doctor-name {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .doctor-occupation {
            font-size: 14px;
            margin: 0;
        }

        .appointment-time,
        .appointment-patient {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        h4,
        p {
            margin: 0;
        }

        .see-more {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="sidebar-logo">
                    <img class="logo-container" src="../Milestone/Img/logo.png" alt="Logo" height="50px">
                </div>
                <div class="sidebar-nav">
                    <a href="dashboard.php"
                        style="text-decoration: none; color: #089FA6; font-weight: 500; background-color: #EAE8E7; box-shadow: inset -10px 0px 0px #089FA6; color: #089FA6;">Dashboard</a>
                    <a href="dentists.php" style="text-decoration: none; color: #AAAAAA; font-weight: 500;">Dentists</a>
                    <a href="patients.php" style="text-decoration: none; color: #AAAAAA; font-weight: 500;">Patients</a>
                    <a href="logout.php" style="text-decoration: none; color: red; font-weight: 500;">Logout</a>
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-10 content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="welcome-text">
                            <h2 style="font-weight: 700;">Welcome Back,
                                <?php echo $login_name; ?>
                            </h2>
                            <p style="color: #AAAAAA;">Here are your upcoming appointments.</p>
                        </div>
                        <div>
                            <img src="../Final/Img/today.png" height="16.7px">
                        </div>


                        <div class="block" style="margin-top: 7px">
                            <div class="appointment-details">
                                <div class="doctor-info">
                                    <div class="doctor-image"></div>
                                    <div class="doctor-name-occupation">
                                        <h4 class="doctor-name">Doctor Name</h4>
                                        <p class="doctor-occupation">Doctor Occupation</p>
                                    </div>
                                </div>
                                <div class="appointment-time">
                                    .
                                </div>
                                <div class="appointment-patient">
                                    .
                                </div>
                                <div class="appointment-patient">
                                    .
                                </div>
                            </div>
                            <div class="see-more">
                                <p>See more</p>
                            </div>
                        </div>


                        <div>
                            <img src="../Final/Img/tommorow.png" height="16.7px">
                        </div>


                        <div class="block" style="margin-top: 7px">
                            <div class="appointment-details">
                                <div class="doctor-info">
                                    <div class="doctor-image"></div>
                                    <div class="doctor-name-occupation">
                                        <h4 class="doctor-name">Doctor Name</h4>
                                        <p class="doctor-occupation">Doctor Occupation</p>
                                    </div>
                                </div>
                                <div class="appointment-time">
                                    .
                                </div>
                                <div class="appointment-patient">
                                    .
                                </div>
                                <div class="appointment-patient">
                                    .
                                </div>
                            </div>
                            <div class="see-more">
                                <p>See more</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 mt-5">
                        <div style="margin-top: 50px;"></div>
                        <div class="block">
                            <h3>Block 4</h3>
                            <p>Text for Block 4</p>
                        </div>
                        <div class="block">
                            <h3>Block 5</h3>
                            <p>Text for Block 5</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>