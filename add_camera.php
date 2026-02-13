<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $client_names   = $_POST['client_name'];
    $company_branches = $_POST['company_branch'];
    $camera_nos     = $_POST['camera_no'];
    $subnets        = $_POST['subnet'];
    $gateways       = $_POST['gateway'];
    $camera_ips     = $_POST['camera_ip'];
    $locations      = $_POST['camera_location'];
    $serials        = $_POST['camera_serial'];
    $models         = $_POST['camera_model'];
    $macs           = $_POST['mac'];
    $usernames      = $_POST['username'];
    $passwords      = $_POST['password'];

    $count = count($camera_ips);

    for ($i = 0; $i < $count; $i++) {

        $client_name = mysqli_real_escape_string($conn, $client_names[$i]);
        $company_branch = mysqli_real_escape_string($conn, $company_branches[$i]);
        $camera_no   = mysqli_real_escape_string($conn, $camera_nos[$i]);
        $subnet      = mysqli_real_escape_string($conn, $subnets[$i]);
        $gateway     = mysqli_real_escape_string($conn, $gateways[$i]);
        $camera_ip   = mysqli_real_escape_string($conn, $camera_ips[$i]);
        $location    = mysqli_real_escape_string($conn, $locations[$i]);
        $serial      = mysqli_real_escape_string($conn, $serials[$i]);
        $model       = mysqli_real_escape_string($conn, $models[$i]);
        $mac         = mysqli_real_escape_string($conn, $macs[$i]);
        $username    = mysqli_real_escape_string($conn, $usernames[$i]);
        $password    = mysqli_real_escape_string($conn, $passwords[$i]);

        $sql = "INSERT INTO cameras
                (client_name, company_branch, camera_no, subnet, gateway, camera_ip, camera_location, camera_serial_no, camera_model, mac_address, username, password)
                VALUES
                ('$client_name', '$company_branch', '$camera_no', '$subnet', '$gateway', '$camera_ip', '$location', '$serial', '$model', '$mac', '$username', '$password')";

        mysqli_query($conn, $sql);
    }

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Camera Details</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma;
    background: #e0f2f1;
    padding: 30px;
}

.container {
    max-width: 1200px;
    margin: auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #00796b;
}

.camera-card {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    background: #f1f8f7;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 12px;
}

.camera-card input {
    flex: 1 1 150px;
    padding: 7px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.remove-btn {
    background: #e53935;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
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

<h2>Add Camera Details</h2>

<form method="POST">

<div id="cameraContainer">

<div class="camera-card">

<input name="client_name[]" placeholder="Client Name" required> 
<input name="company_branch[]" placeholder="Company Branch" required>
<input name="camera_no[]" placeholder="Camera No" required>
<input name="subnet[]" placeholder="Subnet/Mask" required>
<input name="gateway[]" placeholder="Gateway" required>
<input name="camera_ip[]" placeholder="Camera IP" required>
<input name="camera_location[]" placeholder="Location" required>
<input name="camera_serial[]" placeholder="Serial No" required>
<input name="camera_model[]" placeholder="Model" required>
<input name="mac[]" placeholder="MAC Address" required>
<input name="username[]" placeholder="Username" required>
<input type="password" name="password[]" placeholder="Password" required>

<button type="button" class="remove-btn" onclick="removeCard(this)">X</button>

</div>

</div>

<br>

<button type="button" class="add-btn" onclick="addCard()">+ Add Camera</button>
<button type="submit">Save Data</button>

<button type="button" class="add-btn" onclick="window.location.href='show_camera.php'">
    Show Camera
</button>

<?php if(isset($success)) echo "<p style='color:green;'>Data saved successfully!</p>"; ?>

</form>
</div>

<script>
function addCard() {
    let container = document.getElementById("cameraContainer");
    let card = container.children[0].cloneNode(true);

    card.querySelectorAll("input").forEach(input => input.value = "");
    container.appendChild(card);
}

function removeCard(btn) {
    let container = document.getElementById("cameraContainer");
    if (container.children.length > 1) {
        btn.parentNode.remove();
    }
}
</script>

</body>
</html>

