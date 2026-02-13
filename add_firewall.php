<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $clients        = $_POST['client'];
    $company_branch = $_POST['company_branch'];
    $owners         = $_POST['owner'];
    $static_ips     = $_POST['static_ip'];
    $firewall_ips   = $_POST['firewall_ip'];
    $models         = $_POST['model_no'];
    $serials        = $_POST['serial_no'];
    $usernames      = $_POST['username'];
    $passwords      = $_POST['password'];
    $console_ports  = $_POST['console_port'];
    $port_users     = $_POST['port_user'];
    $vpn_ports      = $_POST['port_vpn'];
    $versions       = $_POST['version'];
    $expiries       = $_POST['expiry_date'];
    $storage_pass   = $_POST['storage_password'];
    $backup_sets    = $_POST['backup_set'];

    $count = count($clients);

    for ($i = 0; $i < $count; $i++) {

        $client   = mysqli_real_escape_string($conn, $clients[$i]);
        $company_branch   = mysqli_real_escape_string($conn, $company_branch[$i]);
        $owner    = mysqli_real_escape_string($conn, $owners[$i]);
        $static   = mysqli_real_escape_string($conn, $static_ips[$i]);
        $fw_ip    = mysqli_real_escape_string($conn, $firewall_ips[$i]);
        $model    = mysqli_real_escape_string($conn, $models[$i]);
        $serial   = mysqli_real_escape_string($conn, $serials[$i]);
        $user     = mysqli_real_escape_string($conn, $usernames[$i]);
        $pass     = mysqli_real_escape_string($conn, $passwords[$i]);
        $console  = mysqli_real_escape_string($conn, $console_ports[$i]);
        $puser    = mysqli_real_escape_string($conn, $port_users[$i]);
        $vpn      = mysqli_real_escape_string($conn, $vpn_ports[$i]);
        $version  = mysqli_real_escape_string($conn, $versions[$i]);
        $expiry   = mysqli_real_escape_string($conn, $expiries[$i]);
        $storage  = mysqli_real_escape_string($conn, $storage_pass[$i]);
        $backup   = mysqli_real_escape_string($conn, $backup_sets[$i]);

        $sql = "INSERT INTO firewalls
        (client, company_branch, owner, static_ip, firewall_ip, model_no, serial_no, username, password,
         console_port, port_user, port_vpn, version, expiry_date, storage_password, backup_set)
        VALUES
        ('$client','$company_branch','$owner','$static','$fw_ip','$model','$serial','$user','$pass',
         '$console','$puser','$vpn','$version','$expiry','$storage','$backup')";

        mysqli_query($conn, $sql);
    }

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Firewall</title>

<style>
body {
    font-family: 'Segoe UI';
    background: #e0f2f1;
    padding: 30px;
}

.container {
    max-width: 1200px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.firewall-card {
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    background:#f1f8ff;
    padding:12px;
    border-radius:8px;
    margin-bottom:10px;
}

.firewall-card input{
    flex:1 1 150px;
    padding:7px;
}

.remove-btn{
    background:red;
    color:white;
    border:none;
    padding:8px;
    cursor:pointer;
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

<h2>Add Firewall Details</h2>

<form method="POST">

<div id="container">

<div class="firewall-card">

<input name="client[]" placeholder="Client" required>
<input name="company_branch[]" placeholder="Company Branch" required>
<input name="owner[]" placeholder="Owner" required>
<input name="static_ip[]" placeholder="Static IP" required>
<input name="firewall_ip[]" placeholder="Firewall IP" required>
<input name="model_no[]" placeholder="Model No" required>
<input name="serial_no[]" placeholder="Serial No" required>
<input name="username[]" placeholder="Username" required>
<input type="password" name="password[]" placeholder="Password" required>
<input name="console_port[]" placeholder="Console Port" required>
<input name="port_user[]" placeholder="Port User" required>
<input name="port_vpn[]" placeholder="VPN Port" required>
<input name="version[]" placeholder="Version" required>
<input type="date" name="expiry_date[]" required>
<input name="storage_password[]" placeholder="Storage Password" required>
<input name="backup_set[]" placeholder="Backup Set" required>

<button type="button" class="remove-btn" onclick="removeCard(this)">X</button>

</div>
</div>

<br>
<button type="button" class="add-btn" onclick="addCard()">+ Add Server</button>
<button type="submit">Save Data</button>

<button type="button" class="add-btn" onclick="window.location.href='show_firewall.php'">
    Show Firewall
</button>

<?php if(isset($success)) echo "<p style='color:green'>Saved successfully!</p>"; ?>

</form>
</div>

<script>
function addCard() {
    let first = document.querySelector(".firewall-card");
    let clone = first.cloneNode(true);

    clone.querySelectorAll("input").forEach(i => i.value = "");

    document.getElementById("container").appendChild(clone);
}

function removeCard(btn) {
    let container = document.getElementById("container");
    if(container.children.length > 1)
        btn.parentNode.remove();
}
</script>

</body>
</html>
