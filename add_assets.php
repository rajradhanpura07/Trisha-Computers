<?php include 'header.php'; ?>

<style>

body {
    background: linear-gradient(135deg, #4e73df, #1cc88a);
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;

    flex-direction: column; /* stack header, content, footer */
}

/* Page wrapper */
.page-wrapper{
    max-width: 1200px;
    margin: 40px auto 80px;
    padding: 0 20px;
}

/* Title */
.page-title{
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 30px;
}

/* Grid layout */
.asset-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 24px;
}

/* Cards */
.asset-card {
    background: #fff;
    padding: 40px 25px;
    border-radius: 14px;
    text-align: center;
    text-decoration: none;
    color: #333;
    font-weight: 600;
    font-size: 17px;

    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.25s ease;
}

/* Hover */
.asset-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 22px rgba(0,0,0,0.15);
    background: #007BFF;
    color: #fff;
}

/* Icon spacing */
.asset-card span{
    display:block;
    font-size:32px;
    margin-bottom:12px;
}
</style>


<div class="page-wrapper">

    <h1 class="page-title">Add Assets</h1>

    <div class="asset-grid">
        <a href="add_server.php" class="asset-card">
            <span>🖥</span> Add Server
        </a>

        <a href="add_firewall.php" class="asset-card">
            <span>🔥</span> Add Firewall
        </a>

        <a href="add_switch.php" class="asset-card">
            <span>🔀</span> Add Switch
        </a>

        <a href="add_ap.php" class="asset-card">
            <span>📡</span> Add Access Point
        </a>

        <a href="add_printer.php" class="asset-card">
            <span>🖨</span> Add Printer
        </a>

        <a href="add_camera.php" class="asset-card">
            <span>📷</span> Add Camera
        </a>

        <a href="add_nvr.php" class="asset-card">
            <span>💾</span> Add NVR
        </a>
    </div>

</div>

<?php include 'footer.php'; ?>
