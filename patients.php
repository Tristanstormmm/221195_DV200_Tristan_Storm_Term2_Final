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
                        style="text-decoration: none; color: #AAAAAA; font-weight: 500;">Dashboard</a>
                    <a href="dentists.php" style="text-decoration: none; color: #AAAAAA; font-weight: 500;">Dentists</a>
                    <a href="patients.php"
                        style="text-decoration: none; color: #089FA6; font-weight: 500; background-color: #EAE8E7; box-shadow: inset -10px 0px 0px #089FA6; color: #089FA6;">Patients</a>
                    <a href="logout.php" style="text-decoration: none; color: red; font-weight: 500;">Logout</a>
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-10 content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="welcome-text">
                            <h2>Welcome</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <div class="block">
                            <h3>Block 1</h3>
                            <p>Text for Block 1</p>
                        </div>
                        <div class="block">
                            <h3>Block 2</h3>
                            <p>Text for Block 2</p>
                        </div>
                        <div class="block">
                            <h3>Block 3</h3>
                            <p>Text for Block 3</p>
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