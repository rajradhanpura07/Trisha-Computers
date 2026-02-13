<?php include 'header.php'; ?>

<main class="about-page">

    <!-- About Hero -->
    <section class="about-hero">
        <h1>About Trisha Computers</h1>
        <p>Delivering trusted IT solutions with quality, reliability, and innovation.</p>
    </section>

    <!-- About Content -->
    <section class="about-content">
        <h2>Who We Are</h2>
        <p>
            Trisha Computers is a professional IT company providing computer sales,
            repair services, networking solutions, and technical support.
            We focus on delivering reliable and affordable technology solutions
            to individuals and businesses.
        </p>

        <h2>Our Mission</h2>
        <p>
            Our mission is to simplify technology for our customers by providing
            high-quality products, expert services, and dependable support.
        </p>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <h2>Our Leadership</h2>

        <?php
            $team = [
                ["name" => "Gaurav Sharma", "role" => "Founder & CEO"],
                ["name" => "Gaurav Sharma", "role" => "Technical Head"],
                ["name" => "Mandar Upadhyay", "role" => "Customer Support Manager"]
            ];

            foreach ($team as $member) {
                echo "<div class='team-card'>
                        <h3>{$member['name']}</h3>
                        <p>{$member['role']}</p>
                      </div>";
            }
        ?>
    </section>

</main>

<?php include 'footer.php'; ?>
