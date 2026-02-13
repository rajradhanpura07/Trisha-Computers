<?php
include "db_connect.php"; // Make sure this file has your $conn connection

// Get client name from query string (optional)
$client_name = isset($_GET['client']) ? $_GET['client'] : '';

// Prepare query
if ($client_name != '') {
    $stmt = $conn->prepare("SELECT * FROM servers WHERE company_name = ?");
    $stmt->bind_param("s", $client_name);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Show all servers if no client is specified
    $result = $conn->query("SELECT * FROM servers");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Server Details</title>
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
}

th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #00796b;
    color: white;
}

tr:nth-child(even) {
    background-color: #f1f8f7;
}

tr:hover {
    background-color: #d0f0ed;
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

</style>
</head>
<body>

<h1>Server Details <?php echo $client_name ? "for " . htmlspecialchars($client_name) : ""; ?></h1>

<div class="top-bar">

<form method="GET">
    <input type="text" name="search" placeholder="Search server..." value="<?php echo $search; ?>">
    <button type="submit" class="add-btn">Search</button>
</form>

<a href="add_server.php" class="add-btn">Add New Server</a>

</div>

<table>
    <tr>
        <th>ID</th>
        <th>Company Name</th>
        <th>Company Branch</th>
        <th>Server IP</th>
        <th>Port</th>
        <th>Server Name</th>
        <th>Domain</th>
        <th>Username</th>
        <th>Password</th>
        <th>Quick Heal Pass</th>
        <th>Expiry Date</th>
        <th>Product Key</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['company_name']}</td>
                    <td>{$row['company_branch']}</td>
                    <td>{$row['server_ip']}</td>
                    <td>{$row['port']}</td>
                    <td>{$row['server_name']}</td>
                    <td>{$row['domain']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['qh_password']}</td>
                    <td>{$row['qh_expiry']}</td>
                    <td>{$row['qh_key']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='11' style='text-align:center;'>No server records found.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
