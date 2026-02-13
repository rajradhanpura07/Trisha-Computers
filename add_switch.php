<?php
include 'db_connect.php';

$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $clients     = $_POST['client'];
    $company_branches = $_POST['company_branch'];
    $switch_ips  = $_POST['switch_ip'];
    $usernames   = $_POST['username'];
    $passwords   = $_POST['password'];
    $models      = $_POST['model_no'];
    $serials     = $_POST['serial_no'];
    $macs        = $_POST['mac_address'];
    $locations   = $_POST['location'];
    $vlans       = $_POST['vlans'];

    $count = count($switch_ips);

    for ($i = 0; $i < $count; $i++) {

        $client    = mysqli_real_escape_string($conn, $clients[$i]);
        $branch    = mysqli_real_escape_string($conn, $company_branches[$i]);
        $ip        = mysqli_real_escape_string($conn, $switch_ips[$i]);
        $username  = mysqli_real_escape_string($conn, $usernames[$i]);
        $password  = mysqli_real_escape_string($conn, $passwords[$i]);
        $model     = mysqli_real_escape_string($conn, $models[$i]);
        $serial    = mysqli_real_escape_string($conn, $serials[$i]);
        $mac       = mysqli_real_escape_string($conn, $macs[$i]);
        $location  = mysqli_real_escape_string($conn, $locations[$i]);

        mysqli_query($conn, "INSERT INTO switches
            (client, company_branch, switch_ip, username, password, model_no, serial_no, mac_address, location)
            VALUES
            ('$client','$branch','$ip','$username','$password','$model','$serial','$mac','$location')");

        $switch_id = mysqli_insert_id($conn);

        if (!empty($vlans[$i])) {
            foreach ($vlans[$i] as $vlan) {

                $vid  = mysqli_real_escape_string($conn, $vlan['id']);
                $name = mysqli_real_escape_string($conn, $vlan['name']);
                $vip  = mysqli_real_escape_string($conn, $vlan['ip']);

                mysqli_query($conn, "INSERT INTO switch_vlans
                    (switch_id, vlan_id, vlan_name, vlan_ip)
                    VALUES
                    ('$switch_id','$vid','$name','$vip')");
            }
        }
    }

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Switch</title>

<style>
body{
    font-family:Segoe UI;
    background:#e0f2f1;
    padding:30px;
}

.container{
    max-width:1000px;
    margin:auto;
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.switch-card{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    background:#f1f8f7;
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
}

.switch-card input{
    flex:1 1 150px;
    padding:8px;
}

.vlan-box{
    display:flex;
    gap:10px;
    width:100%;
    margin-top:6px;
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

.remove-btn {
    background: #e53935;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    cursor: pointer;
    flex: 0 0 auto;
    font-size: 16px;
}

.remove-btn:hover {
    background: #b71c1c;
}

.remove-vlan-btn{
    background:#e53935;
    color:#fff;
    border:none;
    padding:6px 10px;
    border-radius:5px;
    cursor:pointer;
    font-size:13px;
}


h3{width:100%;margin:10px 0 0}
</style>
</head>

<body>

<div class="container">
<h2>Add Switch Details</h2>

<form method="POST" id="switchForm">

<div id="switchContainer">

<div class="switch-card">

    <input name="client[]" placeholder="Client" required>
    <input name="company_branch[]" placeholder="Branch" required>
    <input name="switch_ip[]" placeholder="Switch IP" required>
    <input name="username[]" placeholder="Username" required>
    <input type="password" name="password[]" placeholder="Password" required>
    <input name="model_no[]" placeholder="Model No" required>
    <input name="serial_no[]" placeholder="Serial No" required>
    <input name="mac_address[]" placeholder="MAC" required>
    <input name="location[]" placeholder="Location" required>

    <h3>VLANs</h3>

    <div class="vlanContainer">

        <div class="vlan-box">
            <input name="vlans[0][0][id]" placeholder="VLAN ID" required>
            <input name="vlans[0][0][name]" placeholder="Name" required>
            <input name="vlans[0][0][ip]" placeholder="IP" required>

            <button type="button" class="remove-vlan-btn" onclick="removeVlan(this)">X</button>

        </div>

    </div>

    <div style="margin-top:10px;">
    <button type="button" class="add-btn" onclick="addVlan(this)">+ VLAN</button>
    <button type="button" class="remove-btn" onclick="removeCard(this)">Remove Switch</button>
    </div>

</div>

</div>

<br>
<button type="button" class="add-btn" onclick="addSwitch()">+ Add Switch</button>
<button type="submit">Save Data</button>

<button type="button" class="add-btn" onclick="window.location.href='show_switch.php'">
    Show Switch
</button>

<?php if($success) echo "<p style='color:green;'>Saved successfully!</p>"; ?>

</form>
</div>

<script>

let switchIndex = 1;

function addSwitch(){
    let container = document.getElementById("switchContainer");
    let card = container.children[0].cloneNode(true);

    card.querySelectorAll("input").forEach(i=>i.value="");

    let vlanContainer = card.querySelector(".vlanContainer");

    vlanContainer.innerHTML = `
        <div class="vlan-box">
            <input name="vlans[${switchIndex}][0][id]" placeholder="VLAN ID">
            <input name="vlans[${switchIndex}][0][name]" placeholder="Name">
            <input name="vlans[${switchIndex}][0][ip]" placeholder="IP">
        </div>
    `;

    container.appendChild(card);
    switchIndex++;
}

function addVlan(btn){

    let card = btn.closest(".switch-card");
    let vlanContainer = card.querySelector(".vlanContainer");

    let sIndex = Array.from(document.querySelectorAll(".switch-card")).indexOf(card);
    let vIndex = vlanContainer.children.length;

    let div = document.createElement("div");
    div.className = "vlan-box";

    div.innerHTML = `
        <input name="vlans[${sIndex}][${vIndex}][id]" placeholder="VLAN ID">
        <input name="vlans[${sIndex}][${vIndex}][name]" placeholder="Name">
        <input name="vlans[${sIndex}][${vIndex}][ip]" placeholder="IP">
    `;

    vlanContainer.appendChild(div);
}

function removeCard(btn){
    let container = document.getElementById("switchContainer");

    if(container.children.length > 1){
        btn.closest(".switch-card").remove();
        reindexSwitches(); // keep indexes correct
    }
}

function removeVlan(btn){
    let container = btn.closest(".vlanContainer");

    // keep at least 1 vlan
    if(container.children.length > 1){
        btn.closest(".vlan-box").remove();
        reindexSwitches();
    }
}

</script>

</body>
</html>
