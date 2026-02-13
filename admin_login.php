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
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <input type="submit" name="login" value="Login" class="btn-login">
        </form>

        <?php
        session_start();
        include "db_connect.php";
        
        $error = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $name = $_POST['name'];
            $password = $_POST['password'];
        
            $stmt = $conn->prepare("SELECT id, password FROM admin WHERE name=? LIMIT 1");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if($result->num_rows === 1){    
                $row = $result->fetch_assoc();
        
                if(password_verify($password, $row['password'])){
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_name'] = $name;
        
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    $error = "Invalid Password";
                }
            } else {
                $error = "Admin not found";
            }
        }
        ?>
    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
