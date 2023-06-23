<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="left-block">
        <img id="login-img" src="../Milestone/Img/login-img.png">
    </div>
    <div class="right-block">
        <div class="login-form">
            <h2>Account Login</h2>
            <p>Login to your reception account to gain access to the appointments dashboard.</p>
            <?php if (isset($_GET['error'])) { ?>
                <p style="color: red;">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>
            <form method="post" action="login.php">
                <label for="name">Username</label>
                <input type="text" id="username" name="name">
                <br>
                <label for="password">Password</label>
                <input type="password" id="ipassword" name="password">
                <br>
                <div class="remember-me">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me" id="rm">Remember me</label>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</body>

</html>