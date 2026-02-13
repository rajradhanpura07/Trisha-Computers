<?php
include 'db_connect.php';

/* DELETE RECORD */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM nvrs WHERE id=$id");
    header("Location: show_nvr.php");
    exit();
}

/* FETCH DATA */
$result = mysqli_query($conn, "SELECT * FROM nvrs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View NVRs</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    font-family: 'Segoe UI', Tahoma, Verdana;
    background: #e0f2f1;
    padding: 30px;
}

.container {
    max-width: 1200px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #00796b;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th {
    background: #00796b;
    color: white;
}

tr:hover {
    background: #f5f5f5;
}

.delete-btn {
    background: #e53935;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
}

.toggle-btn {
    background: #607d8b;
    color: white;
    border: none;
    padding: 4px 8px;
    cursor: pointer;
    border-radius: 4px;
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

@media(max-width:900px){
    table {
        font-size: 12px;
    }
}
</style>
</head>

<body>

<div class="container">

<h2>NVR List</h2>

<a href="add_nvr.php" class="add-btn">+ Add New NVR</a>

<table>
<thead>
<tr>
    <th>ID</th>
    <th>Client</th>
    <th>Company Branch</th>
    <th>IP</th>
    <th>Model</th>
    <th>Channels</th>
    <th>Serial No</th>
    <th>MAC</th>
    <th>Username</th>
    <th>Password</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['client_name'] ?></td>
    <td><?= $row['company_branch'] ?></td>
    <td><?= $row['nvr_ip'] ?></td>
    <td><?= $row['nvr_model'] ?></td>
    <td><?= $row['nvr_channel'] ?></td>
    <td><?= $row['serial_no'] ?></td>
    <td><?= $row['mac_address'] ?></td>
    <td><?= $row['username'] ?></td>

    <td>
        <input type="password" value="<?= $row['password'] ?>" readonly id="pass<?= $row['id'] ?>" style="width:90px;">
        <button class="toggle-btn" onclick="togglePass(<?= $row['id'] ?>)">Show</button>
    </td>

    <td>
        <a class="delete-btn" 
           onclick="return confirm('Delete this NVR?')" 
           href="?delete=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</tbody>
</table>

</div>

<script>
function togglePass(id) {
    let field = document.getElementById("pass" + id);
    field.type = field.type === "password" ? "text" : "password";
}
</script>

</body>
</html>
