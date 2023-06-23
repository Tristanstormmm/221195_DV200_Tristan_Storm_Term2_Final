<?php
session_start();
include "db_login.php";

if (isset($_POST['name']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $pass = validate($_POST['password']);

    if (empty($name)) {
        header("Location: index.php?error=Username is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM receptionists WHERE name='$name' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['name'] === $name && $row['password'] === $pass) {
                $_SESSION['login_name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: dashboard.php");
                exit();
            }
        }
    }

    // If the login fails, redirect with an error message
    header("Location: index.php?error=Incorrect Username or Password");
    exit();

} else {
    header("Location: index.php");
    exit();
}
