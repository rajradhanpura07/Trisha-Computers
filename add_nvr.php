<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $client_names  = $_POST['client_name'];
    $company_branches = $_POST['company_branch'];
    $nvr_ips       = $_POST['nvr_ip'];
    $models        = $_POST['nvr_model'];
    $channels      = $_POST['nvr_channel'];
    $serials       = $_POST['serial_no'];
    $macs          = $_POST['mac_address'];
    $usernames     = $_POST['username'];
    $passwords     = $_POST['password'];

    $count = count($nvr_ips);

    for ($i = 0; $i < $count; $i++) {

        $client_name = mysqli_real_escape_string($conn, $client_names[$i]);
        $company_branch = mysqli_real_escape_string($conn, $company_branches[$i]);
        $nvr_ip      = mysqli_real_escape_string($conn, $nvr_ips[$i]);
        $model       = mysqli_real_escape_string($conn, $models[$i]);
        $channel     = mysqli_real_escape_string($conn, $channels[$i]);
        $serial      = mysqli_real_escape_string($conn, $serials[$i]);
        $mac         = mysqli_real_escape_string($conn, $macs[$i]);
        $username    = mysqli_real_escape_string($conn, $usernames[$i]);
        $password    = mysqli_real_escape_string($conn, $passwords[$i]);

        $sql = "INSERT INTO nvrs
                (client_name, company_branch, nvr_ip, nvr_model, nvr_channel, serial_no, mac_address, username, password)
                VALUES
                ('$client_name','$company_branch','$nvr_ip','$model','$channel','$serial','$mac','$username','$password')";

        mysqli_query($conn, $sql);
    }

    $success = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add NVR</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
    background: #e0f2f1;
    padding: 30px;
}

.container {
    max-width: 1100px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #1565c0;
}

.nvr-card {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    background: #f1f6fb;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 12px;
}

.nvr-card input {
    flex: 1 1 140px;
    padding: 7px;
}

.remove-btn {
    background: red;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
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

</style>
</head>
<body>

<div class="container">
<h2>Add NVR Details</h2>

<form method="POST">

<div id="nvrContainer">

<div class="nvr-card">
    <input name="client_name[]" placeholder="Client Name" required>
    <input name="company_branch[]" placeholder="Company Branch" required>
    <input name="nvr_ip[]" placeholder="NVR IP" required>
    <input name="nvr_model[]" placeholder="Model" required>
    <input name="nvr_channel[]" placeholder="Channels" required>
    <input name="serial_no[]" placeholder="Serial No" required>
    <input name="mac_address[]" placeholder="MAC Address" required>
    <input name="username[]" placeholder="Username" required>
    <input type="password" name="password[]" placeholder="Password" required>
    <button type="button" class="remove-btn" onclick="removeCard(this)">X</button>
</div>

</div>

<br>

<button type="button" class="add-btn" onclick="addCard()">+ Add NVR</button>
<button type="submit">Save Data</button>

<button type="button" class="add-btn" onclick="window.location.href='show_nvr.php'">
    Show NVR
</button>

<?php if(!empty($success)) echo "<p style='color:green;'>Data saved successfully!</p>"; ?>

</form>

</div>

<script>
function addCard() {
    let container = document.getElementById("nvrContainer");
    let card = container.children[0].cloneNode(true);

    let inputs = card.querySelectorAll("input");
    inputs.forEach(input => input.value = "");

    container.appendChild(card);
}

function removeCard(btn) {
    let container = document.getElementById("nvrContainer");
    if (container.children.length > 1) {
        btn.parentNode.remove();
    }
}
</script>

</body>
</html>
