<?php
include 'db_connect.php';

/*
   LEFT JOIN so switches without VLANs also show
*/
$sql = "SELECT s.*, v.vlan_id, v.vlan_name, v.vlan_ip
        FROM switches s
        LEFT JOIN switch_vlans v ON s.id = v.switch_id
        ORDER BY s.id DESC";

$result = mysqli_query($conn, $sql);

$switches = [];

while($row = mysqli_fetch_assoc($result)){
    $sid = $row['id'];

    if(!isset($switches[$sid])){
        $switches[$sid] = [
            "info" => $row,
            "vlans" => []
        ];
    }

    if($row['vlan_id']){
        $switches[$sid]['vlans'][] = [
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
<title>Switch List</title>

<style>
body{
    font-family:Segoe UI;
    background:#e0f2f1;
    padding:25px;
}

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

.vlan-table{
    margin:10px 0;
    background:#f5f9ff;
}

h2{
    text-align:center;
    color:#1565c0;
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

<h2>Switch Details</h2>

<a href="add_switch.php" class="add-btn">+ Add New Switch</a>


<?php if(empty($switches)){ ?>
    <p>No switch data found.</p>
<?php } ?>

<?php foreach($switches as $sw){ ?>

<table>

<tr>
<th>Client</th>
<th>Company Branch</th>
<th>Switch IP</th>
<th>Username</th>
<th>Model</th>
<th>Serial</th>
<th>MAC</th>
<th>Location</th>
</tr>

<tr>
<td><?= $sw['info']['client'] ?></td>
<td><?= $sw['info']['company_branch'] ?></td>
<td><?= $sw['info']['switch_ip'] ?></td>
<td><?= $sw['info']['username'] ?></td>
<td><?= $sw['info']['model_no'] ?></td>
<td><?= $sw['info']['serial_no'] ?></td>
<td><?= $sw['info']['mac_address'] ?></td>
<td><?= $sw['info']['location'] ?></td>
</tr>

<tr>
<td colspan="7">

<b>VLANs:</b>

<table class="vlan-table">
<tr>
<th>VLAN ID</th>
<th>VLAN Name</th>
<th>VLAN IP</th>
</tr>

<?php if(!empty($sw['vlans'])): ?>
    <?php foreach($sw['vlans'] as $v): ?>
    <tr>
        <td><?= $v['id'] ?></td>
        <td><?= $v['name'] ?></td>
        <td><?= $v['ip'] ?></td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="3">No VLANs added</td></tr>
<?php endif; ?>

</table>

</td>
</tr>

</table>

<?php } ?>

</body>
</html>
