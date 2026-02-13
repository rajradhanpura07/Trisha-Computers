<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $clients    = $_POST['client_name'];
    $company_branches = $_POST['company_branch'];
    $ips        = $_POST['router_ip'];
    $models     = $_POST['model_no'];
    $usernames  = $_POST['username'];
    $passwords  = $_POST['password'];
    $names      = $_POST['router_name'];
    $macs       = $_POST['mac_address'];
    $serials    = $_POST['serial_no'];
    $locations  = $_POST['location'];
    $ssids      = $_POST['ssids'];

    $count = count($ips);

    for ($i = 0; $i < $count; $i++) {

        $client   = mysqli_real_escape_string($conn, $clients[$i]);
        $branch   = mysqli_real_escape_string($conn, $company_branches[$i]);
        $ip       = mysqli_real_escape_string($conn, $ips[$i]);
        $model    = mysqli_real_escape_string($conn, $models[$i]);
        $username = mysqli_real_escape_string($conn, $usernames[$i]);
        $password = mysqli_real_escape_string($conn, $passwords[$i]);
        $name     = mysqli_real_escape_string($conn, $names[$i]);
        $mac      = mysqli_real_escape_string($conn, $macs[$i]);
        $serial   = mysqli_real_escape_string($conn, $serials[$i]);
        $location = mysqli_real_escape_string($conn, $locations[$i]);

        $sql = "INSERT INTO routers
                (client_name, company_branch, router_ip, model_no, username, password, router_name, mac_address, serial_no, location)
                VALUES
                ('$client','$branch','$ip','$model','$username','$password','$name','$mac','$serial','$location')";
        mysqli_query($conn, $sql);

        $router_id = mysqli_insert_id($conn);

        if(!empty($ssids[$i])){
            foreach($ssids[$i] as $s){

                $vid  = mysqli_real_escape_string($conn, $s['id']);
                $vname = mysqli_real_escape_string($conn, $s['name']);
                $vip   = mysqli_real_escape_string($conn, $s['ip']);

                mysqli_query($conn,
                    "INSERT INTO router_ssids (router_id, vlan_id, vlan_name, vlan_ip)
                     VALUES ('$router_id','$vid','$vname','$vip')");
            }
        }
    }

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Router / AP</title>

<style>
body{
    font-family:'Segoe UI',Tahoma;
    background:#e0f2f1;
    padding:30px;
}

.container{
    max-width:1100px;
    margin:auto;
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.router-card{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    background:#f1f8f7;
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
}

input{
    padding:8px;
    flex:1 1 150px;
    border:1px solid #ccc;
    border-radius:6px;
}

.ssid-box{
    display:flex;
    gap:8px;
    width:100%;
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
.remove-btn{background:#e53935;color:white}
</style>
</head>

<body>

<div class="container">
<h2>Add Router / AP Details</h2>

<form method="POST">

<div id="routerContainer">

<div class="router-card">

<input name="client_name[]" placeholder="Client Name" required>
<input name="company_branch[]" placeholder="Company Branch" required>
<input name="router_ip[]" placeholder="Router IP" required>
<input name="model_no[]" placeholder="Model No" required>
<input name="username[]" placeholder="Username" required>
<input type="password" name="password[]" placeholder="Password" required>
<input name="router_name[]" placeholder="Router Name" required>
<input name="mac_address[]" placeholder="MAC Address" required>
<input name="serial_no[]" placeholder="Serial No" required>
<input name="location[]" placeholder="Location" required>

<div class="ssidContainer">

<div class="ssid-box">
<input name="ssids[0][0][id]" placeholder="SSID VLAN ID" required>
<input name="ssids[0][0][name]" placeholder="SSID Name" required>
<input name="ssids[0][0][ip]" placeholder="SSID IP" required>
</div>

</div>

<button type="button" onclick="addSSID(this)">+ SSID</button>
<button type="button" class="remove-btn" onclick="removeRouter(this)">X</button>

</div>
</div>

<br>
<button type="button" class="add-btn" onclick="addRouter()">+ Add Router</button>
<button type="submit" class="add-btn">Save Data</button>

<button type="button" class="add-btn" onclick="window.location.href='show_ap.php'">
    Show AP
</button>

<?php if(!empty($success)) echo "<p style='color:green;'>Data saved successfully!</p>"; ?>

</form>
</div>

<script>

let routerIndex = 1;

function addRouter(){
    let container = document.getElementById("routerContainer");
    let card = container.children[0].cloneNode(true);

    card.querySelectorAll("input").forEach(i=>i.value="");

    let ssidBox = `
        <div class="ssid-box">
            <input name="ssids[${routerIndex}][0][id]" placeholder="SSID VLAN ID">
            <input name="ssids[${routerIndex}][0][name]" placeholder="SSID Name">
            <input name="ssids[${routerIndex}][0][ip]" placeholder="SSID IP">
        </div>
    `;

    card.querySelector(".ssidContainer").innerHTML = ssidBox;

    container.appendChild(card);
    routerIndex++;
}

function addSSID(btn){
    let card = btn.closest(".router-card");
    let container = card.querySelector(".ssidContainer");

    let rIndex = [...document.querySelectorAll(".router-card")].indexOf(card);
    let sIndex = container.children.length;

    let div = document.createElement("div");
    div.className="ssid-box";

    div.innerHTML = `
        <input name="ssids[${rIndex}][${sIndex}][id]" placeholder="SSID VLAN ID">
        <input name="ssids[${rIndex}][${sIndex}][name]" placeholder="SSID Name">
        <input name="ssids[${rIndex}][${sIndex}][ip]" placeholder="SSID IP">
    `;

    container.appendChild(div);
}

function removeRouter(btn){
    let container = document.getElementById("routerContainer");
    if(container.children.length>1)
        btn.closest(".router-card").remove();
}
</script>

</body>
</html>
