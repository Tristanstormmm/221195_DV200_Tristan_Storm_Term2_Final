<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Include the database connection
include 'db.php';

$error = ''; // Initialize the error variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the login credentials from the form
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Perform the login validation
    $query = "SELECT * FROM receptionists WHERE name = '$name' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // If login is successful, store the receptionist ID and rank in session variables
        $receptionist = mysqli_fetch_assoc($result);
        $_SESSION['receptionist_id'] = $receptionist['id'];
        $_SESSION['rank'] = $receptionist['rank'];

        // Redirect to the dashboard page
        header("Location: dashboard.php");
        exit;
    } else {
        // If login fails, set the error message
        $error = "Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dentist Receptionist Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .left-block {
            width: 50%;
            background-color: #089FA6;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        #login-img {
            height: 60%;
        }

        .right-block {
            width: calc(100% - 50%);
            background-color: white;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Inter', sans-serif;
        }

        .login-form {
            width: 400px;
            background-color: white;
            position: relative;
            margin-top: 26%;
        }

        .login-form h2 {
            font-weight: 700;
        }

        .login-form p {
            color: #AAAAAA;
        }

        #username {
            width: 100%;
            border-radius: 6px;
            height: 50px;
            border: 1px solid #AAAAAA;
            padding-left: 10px;
        }

        #password {
            width: 100%;
            border-radius: 6px;
            height: 50px;
            border: 1px solid #AAAAAA;
            padding-left: 10px;
        }

        .login-form label {
            padding-top: 10px;
        }

        #remember-me {
            padding-top: 10px;
        }

        .login-btn {
            width: 100%;
            height: 50px;
            border-radius: 6px;
            background-color: #089FA6;
            border: #089FA6;
            margin-top: 20px;
            color: white;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="left-block">
        <img src="../dentist_website/images/login-img.png">
    </div>
    <div class="right-block">
        <div class="login-form">
            <h2>Receptionist Login</h2>
            <p>Login to your reception account to gain access to the appointments dashboard.</p>
            <p class="error" style="color: red;">
                <?php echo $error; ?>
            </p>
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
</body>

</html>