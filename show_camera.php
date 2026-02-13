<?php
include 'db_connect.php';

/* DELETE CAMERA */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM cameras WHERE id=$id");
    header("Location: show_camera.php");
    exit();
}

/* FETCH DATA */
$result = mysqli_query($conn, "SELECT * FROM cameras ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Show Cameras</title>

<style>
body{
    font-family: 'Segoe UI', Tahoma;
    background:#e0f2f1;
    padding:25px;
}

.container{
    max-width:1300px;
    margin:auto;
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    color:#00796b;
}

.search-box{
    margin-bottom:15px;
    text-align:right;
}

.search-box input{
    padding:8px;
    width:250px;
    border-radius:6px;
    border:1px solid #ccc;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

th,td{
    padding:8px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#00796b;
    color:white;
}

tr:nth-child(even){
    background:#f1f8f7;
}

.action-btn{
    padding:5px 10px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    color:white;
}

.delete{
    background:#e53935;
}

.edit{
    background:#0288d1;
}

.showpass{
    background:#ffffff;
    padding:4px 8px;
    font-size:12px;
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

<div class="container">

<h2>Camera List</h2>

<a href="add_camera.php" class="add-btn">Add New Camera</a>

<div class="search-box">
    <input type="text" id="search" placeholder="Search...">
</div>

<table id="cameraTable">

<thead>
<tr>
<th>ID</th>
<th>Client</th>
<th>Company Branch</th>
<th>No</th>
<th>IP</th>
<th>Location</th>
<th>Model</th>
<th>Serial</th>
<th>MAC</th>
<th>Username</th>
<th>Password</th>
<th>Actions</th>
</tr>
</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>

<td><?= $row['id'] ?></td>
<td><?= $row['client_name'] ?></td>
<td><?= $row['company_branch'] ?></td>
<td><?= $row['camera_no'] ?></td>
<td><?= $row['camera_ip'] ?></td>
<td><?= $row['camera_location'] ?></td>
<td><?= $row['camera_model'] ?></td>
<td><?= $row['camera_serial_no'] ?></td>
<td><?= $row['mac_address'] ?></td>
<td><?= $row['username'] ?></td>

<td>
    <span class="pass">••••••</span>
    <span class="realpass" style="display:none;">
        <?= $row['password'] ?>
    </span>
    <button class="showpass" onclick="togglePass(this)">Show</button>
</td>

<td>
    <a href="?delete=<?= $row['id'] ?>" 
       onclick="return confirm('Delete this camera?')">
        <button class="action-btn delete">Delete</button>
    </a>
</td>

</tr>
<?php } ?>

</tbody>
</table>

</div>

<script>
/* SEARCH */
document.getElementById("search").addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#cameraTable tbody tr");

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});

/* SHOW/HIDE PASSWORD */
function togglePass(btn){
    let td = btn.parentNode;
    let dots = td.querySelector(".pass");
    let real = td.querySelector(".realpass");

    if(real.style.display === "none"){
        real.style.display = "inline";
        dots.style.display = "none";
        btn.innerText = "Hide";
    } else {
        real.style.display = "none";
        dots.style.display = "inline";
        btn.innerText = "Show";
    }
}
</script>

</body>
</html>
