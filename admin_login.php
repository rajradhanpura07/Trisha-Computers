<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_login.css">
</head>

<body class="login-page">

<?php include 'header.php'; ?>

<main class="login-main">
    <div class="login-card">
        <h2>Admin Login</h2>

        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <input type="submit" name="login" value="Login" class="btn-login">
        </form>

        <?php
        include "db_connect.php";

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "<p class='error'>Invalid Login!</p>";
            }
        }
        ?>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
