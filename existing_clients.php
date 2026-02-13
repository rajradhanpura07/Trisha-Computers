<?php
include 'header.php';
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin_login.css">
    <title>Existing Clients</title> 
</head>
<body>

<div class="client-table-wrapper">
<h2>Existing Client Details</h2>

<table class="client-table">

    <tr>
        <th>ID</th>
        <th>Client Name</th>
        <th>Company</th>
        <th>Company Branch</th>
        <th>Email</th>
        <th>Phone</th>
        <th>City</th>
        <th>Priority</th>
        <th>
            Add Assets 
        </th>
        <th>
            Show Assets 
        </th>
    </tr>


<?php

$query = "SELECT * FROM clients ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $client_name = $row['first_name'] . " " . $row['last_name'];

        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$client_name."</td>";
        echo "<td>".$row['company']."</td>";
        echo "<td>".$row['company_branch']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['phone']."</td>";
        echo "<td>".$row['city']."</td>";
        echo "<td>".$row['priority']."</td>";

        echo "<td>
                <a href='add_assets.php?client_id=".$row['id']."'>
                <button class='table-btn btn-add'>Add Assets</button>
                </a>
              </td>";

        echo "<td>
                <a href='show_assets.php?client_id=".$row['id']."'>
                <button class='table-btn btn-show'>Show Assets</button>
                </a>
                </td>";

        echo "</tr>";

    }
} else {
    echo "<tr><td colspan='8'>No client records found</td></tr>";
}
?>
</table>


<br>
<a href="admin_dashboard.php" class="btn-back">Back to Dashboard</a>

</div>
</body>

</html>

<?php include 'footer.php'; ?>
