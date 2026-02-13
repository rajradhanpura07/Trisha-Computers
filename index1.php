<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- SEO Meta -->
    <meta name="description" content="Professional IT services including server setup, network installation, maintenance, repair, and IT sales. Reliable and timely technical support.">
    <meta name="keywords" content="IT services, server setup, network installation, IT maintenance, technical support">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

<section class="hero hero-home">
    <h2>Reliable IT Solutions for Businesses & Individuals</h2>
    <p>
        We provide professional services in server setup, network installation,
        IT maintenance, repair, and IT product sales.
    </p>
    <button onclick="window.location.href='contact.php'">Get IT Support</button>
</section>

<section class="section">
    <h3>Our IT Services</h3>
    <div class="services">
        <div class="card">
            <a href="server-setup-management.php">
            <h4>server setup & management</h4>
            </a>
            <p>Secure server installation, configuration & monitoring.</p>
        </div>
        <div class="card">
            <h4>Network Installation</h4>
            <p>LAN, WAN, Wi-Fi, cabling & network security.</p>
        </div>
        <div class="card">
            <h4>IT Maintenance & Repair</h4>
            <p>Troubleshooting, upgrades & preventive maintenance.</p>
        </div>
        <div class="card">
            <h4>IT Sales & Solutions</h4>
            <p>Servers, networking devices & accessories.</p>
        </div>
        <div class="card">
            <h4>Technical Support</h4>
            <p>Fast on-site & remote IT support.</p>
        </div>
    </div>
</section>

<section class="server-why">
    <h2>Why Choose Us?</h>
    <ul>
        <li>✔ Certified IT Professionals</li>
        <li>✔ Cost-Effective Solutions</li>
        <li>✔ Quick Response Time</li>
        <li>✔ Customer-Focused Support</li>
        <li>✔ Trusted Technology</li>
    </ul>
</section>

<section class="server-cta">
    <h2>Need a Secure & Reliable Server?</h2>
    <p>Let our experts manage your servers while you focus on your business.</p>
    <a href="contact.php" class="cta-btn">Contact Us Today</a>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
