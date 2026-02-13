<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $clients        = $_POST['client'];
    $printer_ips    = $_POST['printer_ip'];
    $printer_names  = $_POST['printer_name'];
    $usernames      = $_POST['username'];
    $password       = $_POST['password'];
    $vlans          = $_POST['vlan'];
    $vlan_ips       = $_POST['vlan_ip'];
    $vlan_ids       = $_POST['vlan_id'];
    $models         = $_POST['model_no'];
    $serials        = $_POST['serial_no'];
    $macs           = $_POST['mac_address'];
    $locations      = $_POST['location'];

    $count = count($printer_ips);

    for ($i = 0; $i < $count; $i++) {

        $client       = mysqli_real_escape_string($conn, $clients[$i]);
        $printer_ip   = mysqli_real_escape_string($conn, $printer_ips[$i]);
        $printer_name = mysqli_real_escape_string($conn, $printer_names[$i]);
        $username     = mysqli_real_escape_string($conn, $usernames[$i]);
        $password     = mysqli_real_escape_string($conn, $password[$i]);
        $vlan         = mysqli_real_escape_string($conn, $vlans[$i]);
        $vlan_ip      = mysqli_real_escape_string($conn, $vlan_ips[$i]);
        $vlan_id      = mysqli_real_escape_string($conn, $vlan_ids[$i]);
        $model_no     = mysqli_real_escape_string($conn, $models[$i]);
        $serial_no    = mysqli_real_escape_string($conn, $serials[$i]);
        $mac_address  = mysqli_real_escape_string($conn, $macs[$i]);
        $location     = mysqli_real_escape_string($conn, $locations[$i]);

        $sql = "INSERT INTO printers
                (client, printer_ip, printer_name, username, password, vlan, vlan_ip, vlan_id, model_no, serial_no, mac_address, location)
                VALUES
                ('$client','$printer_ip','$printer_name','$username','$password','$vlan','$vlan_ip','$vlan_id','$model_no','$serial_no','$mac_address','$location')";

        mysqli_query($conn, $sql);
    }

    $success = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Printer</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
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

.printer-card {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    background: #f1f8f7;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 12px;
}

.printer-card input {
    flex: 1 1 130px;
    padding: 8px;
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

<h2>Add Printer Details</h2>

<form method="POST">

<div id="printerContainer">

<div class="printer-card">
    <input name="client[]" placeholder="Client" required>
    <input name="printer_ip[]" placeholder="Printer IP" required>
    <input name="printer_name[]" placeholder="Printer Name" required>
    <input name="username[]" placeholder="Username" required>
    <input type="password" name="password[]" placeholder="Password" required>
    <input name="vlan[]" placeholder="VLAN Name" required>
    <input name="vlan_ip[]" placeholder="VLAN IP" required>
    <input name="vlan_id[]" placeholder="VLAN ID" required>
    <input name="model_no[]" placeholder="Model No" required>
    <input name="serial_no[]" placeholder="Serial No" required>
    <input name="mac_address[]" placeholder="MAC Address" required>
    <input name="location[]" placeholder="Location" required>

    <button type="button" class="remove-btn" onclick="removeCard(this)">X</button>
</div>

</div>

<br>

<button type="button" class="add-btn" onclick="addCard()">+ Add Printer</button>
<button type="submit">Save Data</button>

<button type="button" class="add-btn" onclick="window.location.href='show_printer.php'">
    Show Printer
</button>

<?php if(isset($success)) echo "<p style='color:green;'>Data saved successfully!</p>"; ?>

</form>

<script>
function addCard() {
    let container = document.getElementById("printerContainer");
    let card = container.children[0].cloneNode(true);

    card.querySelectorAll("input").forEach(input => input.value = "");

    container.appendChild(card);
}

function removeCard(btn) {
    let container = document.getElementById("printerContainer");

    if (container.children.length > 1) {
        btn.parentNode.remove();
    }
}
</script>

</body>
</html>

</div>
