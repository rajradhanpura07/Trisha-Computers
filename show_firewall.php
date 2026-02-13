<?php
include "db_connect.php"; // your DB connection

// Get client name (optional filter)
$client_name = isset($_GET['client']) ? $_GET['client'] : '';

// Prepare query
if ($client_name != '') {
    $stmt = $conn->prepare("SELECT * FROM firewalls WHERE client = ?");
    $stmt->bind_param("s", $client_name);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM firewalls");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Firewall Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #e0f2f1;
    padding: 30px;
}

h1 {
    text-align: center;
    color: #00796b;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    margin: auto;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    font-size: 13px;
}

th, td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #00796b;
    color: white;
}

tr:nth-child(even) {
    background-color: #f1f6fb;
}

tr:hover {
    background-color: #e3f2fd;
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

.top-bar{
    display:flex;
    justify-content:space-between;
    margin-bottom:15px;
}

input[type="text"]{
    padding:8px;
    width:250px;
}

</style>
</head>

<body>

<div class="top-bar">

<form method="GET">
    <input type="text" name="search" placeholder="Search firewall..." value="<?php echo $search; ?>">
    <button type="submit" class="add-btn">Search</button>
</form>

<a href="add_firewall.php" class="add-btn">Add New Firewall</a>

</div>
<h1>
Firewall Details 
<?php echo $client_name ? "for " . htmlspecialchars($client_name) : ""; ?>
</h1>

<table>
<tr>
    <th>ID</th>
    <th>Client</th>
    <th>Company Branch</th>
    <th>Owner</th>
    <th>Static IP</th>
    <th>Firewall IP</th>
    <th>Model No</th>
    <th>Serial No</th>
    <th>Username</th>
    <th>Password</th>
    <th>Console Port</th>
    <th>Port User</th>
    <th>VPN Port</th>
    <th>Version</th>
    <th>Expiry Date</th>
    <th>Storage Password</th>
    <th>Backup Set</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['client']}</td>
            <td>{$row['company_branch']}</td>
            <td>{$row['owner']}</td>
            <td>{$row['static_ip']}</td>
            <td>{$row['firewall_ip']}</td>
            <td>{$row['model_no']}</td>
            <td>{$row['serial_no']}</td>
            <td>{$row['username']}</td>
            <td>{$row['password']}</td>
            <td>{$row['console_port']}</td>
            <td>{$row['port_user']}</td>
            <td>{$row['port_vpn']}</td>
            <td>{$row['version']}</td>
            <td>{$row['expiry_date']}</td>
            <td>{$row['storage_password']}</td>
            <td>{$row['backup_set']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='16' style='text-align:center;'>No firewall records found.</td></tr>";
}
?>

</table>

</body>
</html>

<?php
$conn->close();
?>
