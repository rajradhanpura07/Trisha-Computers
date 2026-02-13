<?php
include 'db_connect.php';

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $sql = "SELECT * FROM printers
            WHERE client LIKE '%$search%'
            OR printer_ip LIKE '%$search%'
            OR printer_name LIKE '%$search%'
            OR model_no LIKE '%$search%'
            OR location LIKE '%$search%'
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM printers ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);


/* DELETE */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM printers WHERE id=$id");
    header("Location: show_printer.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Show Printers</title>

<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#e0f2f1;
    padding:25px;
}

.container{
    max-width:1400px;
    margin:auto;
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

h2{
    text-align:center;
    color:#00796b;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    margin-bottom:15px;
}

input[type="text"]{
    padding:8px;
    width:250px;
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


table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

th, td{
    padding:8px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#00796b;
    color:white;
}

tr:nth-child(even){
    background:#f7f7f7;
}

.action-btn{
    padding:5px 8px;
    font-size:12px;
    border-radius:5px;
    text-decoration:none;
    color:white;
}

.edit{ background:#0288d1; }
.delete{ background:#e53935; }
</style>
</head>
<body>

<div class="container">

<h2>Printer List</h2>

<div class="top-bar">

<form method="GET">
    <input type="text" name="search" placeholder="Search printer..." value="<?php echo $search; ?>">
    <button type="submit" class="add-btn">Search</button>
</form>

<a href="add_printer.php" class="add-btn">Add New Printer</a>

</div>

<table>

<tr>
<th>ID</th>
<th>Client</th>
<th>IP</th>
<th>Name</th>
<th>User</th>
<th>VLAN</th>
<th>VLAN IP</th>
<th>VLAN ID</th>
<th>Model</th>
<th>Serial</th>
<th>MAC</th>
<th>Location</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['client']; ?></td>
<td><?php echo $row['printer_ip']; ?></td>
<td><?php echo $row['printer_name']; ?></td>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['vlan']; ?></td>
<td><?php echo $row['vlan_ip']; ?></td>
<td><?php echo $row['vlan_id']; ?></td>
<td><?php echo $row['model_no']; ?></td>
<td><?php echo $row['serial_no']; ?></td>
<td><?php echo $row['mac_address']; ?></td>
<td><?php echo $row['location']; ?></td>

<td>
    <a class="action-btn delete"
       onclick="return confirm('Delete this printer?')"
       href="?delete=<?php echo $row['id']; ?>">
       Delete
    </a>
</td>
</tr>

<?php } ?>

</table>

</div>
</body>
</html>
