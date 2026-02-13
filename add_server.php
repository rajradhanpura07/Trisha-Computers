<?php
include 'db_connect.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     echo "<pre>";
//     print_r($_POST);
//     echo "</pre>";
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Loop through all server entries
    $company_names = $_POST['company_name'];
    $company_branch = $_POST['company_branch'];
    $server_ips   = $_POST['server_ip'];
    $ports        = $_POST['port'];
    $server_names = $_POST['server_name'];
    $domains      = $_POST['domain'];
    $usernames    = $_POST['username'];
    $passwords    = $_POST['password'];
    $qh_passwords = $_POST['qh_password'];
    $qh_expiries  = $_POST['qh_expiry'];
    $qh_keys      = $_POST['qh_key'];

    $count = count($server_ips); // total rows

    for ($i = 0; $i < $count; $i++) {
        // Sanitize data to prevent SQL injection
        $company_name = mysqli_real_escape_string($conn, $company_names[$i]);
        $company_branch = mysqli_real_escape_string($conn, $company_branch[$i]);
        $server_ip   = mysqli_real_escape_string($conn, $server_ips[$i]);
        $port        = mysqli_real_escape_string($conn, $ports[$i]);
        $server_name = mysqli_real_escape_string($conn, $server_names[$i]);
        $domain      = mysqli_real_escape_string($conn, $domains[$i]);
        $username    = mysqli_real_escape_string($conn, $usernames[$i]);
        $password    = mysqli_real_escape_string($conn, $passwords[$i]);
        $qh_password = mysqli_real_escape_string($conn, $qh_passwords[$i]);
        $qh_expiry   = mysqli_real_escape_string($conn, $qh_expiries[$i]);
        $qh_key      = mysqli_real_escape_string($conn, $qh_keys[$i]);

        // Insert query
        $sql = "INSERT INTO servers 
                (company_name, company_branch, server_ip, port, server_name, domain, username, password, qh_password, qh_expiry, qh_key)
                VALUES 
                ('$company_name', '$company_branch', '$server_ip', '$port', '$server_name', '$domain', '$username', '$password', '$qh_password', '$qh_expiry', '$qh_key')";

        mysqli_query($conn, $sql);
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Server</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #e0f2f1;
    padding: 30px;
}

.container {
    max-width: 1000px;
    margin: auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #00796b;
    margin-bottom: 25px;
}

.server-card {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    background: #f1f8f7;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.server-card input {
    flex: 1 1 150px;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.server-card .remove-btn {
    background: #e53935;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 6px;
    cursor: pointer;
    flex: 0 0 auto;
}

.server-card .remove-btn:hover {
    background: #b71c1c;
}

.add-btn, button[type="submit"] {
    padding: 12px 25px;
    border: none;
    background: #00796b;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    margin-right: 10px;
    font-size: 16px;
}

.add-btn:hover, button[type="submit"]:hover {
    background: #004d40;
}

@media (max-width: 768px) {
    .server-card {
        flex-direction: column;
        gap: 10px;
    }
    .server-card input {
        flex: 1 1 100%;
    }
    .server-card .remove-btn {
        align-self: flex-end;
    }
}
</style>
</head>
<body>

<div class="container">
    <h2>Add Server Details</h2>

    <form method="POST" id="serverForm">
        <div id="serverContainer">
            <div class="server-card">
                <input name="company_name[]" placeholder="Company Name" required>
                <input name="company_branch[]" placeholder="Company Branch" required>
                <input name="server_ip[]" placeholder="Server IP" required>
                <input name="port[]" placeholder="Port" required>
                <input name="server_name[]" placeholder="Server Name" required>
                <input name="domain[]" placeholder="Domain" required>
                <input name="username[]" placeholder="Username" required>
                <input type="password" name="password[]" placeholder="Password" required>
                <input name="qh_password[]" placeholder="Quick Heal Pass" required>
                <input type="date" name="qh_expiry[]" placeholder="Expiry Date" required>
                <input name="qh_key[]" placeholder="Product Key" required>
                <button type="button" class="remove-btn" onclick="removeCard(this)">X</button>
            </div>
        </div>

        <br>
        <button type="button" class="add-btn" onclick="addCard()">+ Add Server</button>
        <button type="submit">Save Data</button>
        
        <button type="button" class="add-btn" onclick="window.location.href='show_server.php'">
            Show Server
        </button>


       <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <p style="color:green;">Data saved successfully!</p>
       <?php } ?>

    </form>
</div>

<script>
function addCard() {
    let container = document.getElementById("serverContainer");
    let card = container.children[0].cloneNode(true);

    // Clear input values
    let inputs = card.querySelectorAll("input");
    inputs.forEach(input => input.value = "");

    container.appendChild(card);
}

function removeCard(button) {
    let container = document.getElementById("serverContainer");
    if (container.children.length > 1) {
        let card = button.parentNode;
        container.removeChild(card);
    }
}
</script>

</body>
</html>
