<?php
include 'db_connect.php';

/*
    Get router + ssids together
*/
$sql = "SELECT r.*, s.vlan_id, s.vlan_name, s.vlan_ip
        FROM routers r
        LEFT JOIN router_ssids s ON r.id = s.router_id
        ORDER BY r.id DESC";

$result = mysqli_query($conn, $sql);

$routers = [];

while($row = mysqli_fetch_assoc($result)){

    $rid = $row['id'];

    if(!isset($routers[$rid])){
        $routers[$rid] = [
            "info" => $row,
            "ssids" => []
        ];
    }

    if($row['vlan_id']){
        $routers[$rid]['ssids'][] = [
            'id'   => $row['vlan_id'],
            'name' => $row['vlan_name'],
            'ip'   => $row['vlan_ip']
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Router / AP List</title>

<style>
body{
    font-family:Segoe UI;
    background:#e0f2f1;
    padding:25px;
}

h2{
    text-align:center;
    color:#00796b;
}

/* router table */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    margin-bottom:25px;
    box-shadow:0 3px 8px rgba(0,0,0,.1);
}

th,td{
    padding:10px;
    border:1px solid #ddd;
    text-align:left;
}

th{
    background:#00796b;
    color:white;
}

/* ssid table */
.ssid-table{
    margin-top:10px;
    background:#f1f8f4;
}

.add-btn {
    display: inline-block;
    margin-bottom: 15px;
    padding: 8px 15px;
    background: #00796b;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 20px;
}

.add-btn:hover, button[type="submit"]:hover {
    background: #004d40;
}
</style>
</head>

<body>

<h2>Router / AP Details</h2>

<a href="add_ap.php" class="add-btn">+ Add New AP</a>

<?php if(empty($routers)){ ?>
    <p>No router data found.</p>
<?php } ?>

<?php foreach($routers as $router){ ?>

<table>

<tr>
    <th>Client</th>
    <th>Company Branch</th>
    <th>Router IP</th>
    <th>Model</th>
    <th>Username</th>
    <th>Router Name</th>
    <th>MAC</th>
    <th>Serial</th>
    <th>Location</th>
</tr>

<tr>
    <td><?= $router['info']['client_name'] ?></td>
    <td><?= $router['info']['company_branch'] ?></td>
    <td><?= $router['info']['router_ip'] ?></td>
    <td><?= $router['info']['model_no'] ?></td>
    <td><?= $router['info']['username'] ?></td>
    <td><?= $router['info']['router_name'] ?></td>
    <td><?= $router['info']['mac_address'] ?></td>
    <td><?= $router['info']['serial_no'] ?></td>
    <td><?= $router['info']['location'] ?></td>
</tr>

<tr>
<td colspan="8">

<b>SSIDs :</b>

<table class="ssid-table">

<tr>
    <th>SSID VLAN ID</th>
    <th>SSID VLAN Name</th>
    <th>SSID VLAN IP</th>
</tr>

<?php if(!empty($router['ssids'])): ?>
    <?php foreach($router['ssids'] as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= $s['name'] ?></td>
            <td><?= $s['ip'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="3">No SSIDs added</td>
    </tr>
<?php endif; ?>

</table>

</td>
</tr>

</table>

<?php } ?>

</body>
</html>
