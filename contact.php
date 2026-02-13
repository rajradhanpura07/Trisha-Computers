<?php include 'header.php'; ?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$successMsg = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Invalid email address.";
    } else {
        // Now create PHPMailer and send
        $mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'mail.aahnacomputers.com';  // your SMTP host
    $mail->SMTPAuth   = true;
    $mail->Username   = 'amit@aahnacomputers.com';  // your email username
    $mail->Password   = '@m!t6102';                 // your email password
    $mail->SMTPSecure = 'tls';                      // STARTTLS
    $mail->Port       = 587;                        // STARTTLS port

    // Optional: Disable SSL verification temporarily for testing
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('support@aahnacomputers.com');

    // Content
    $mail->isHTML(false);
    $mail->Subject = "Contact Form Message from $name";
    $mail->Body    = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

    $mail->send();
    $successMsg = "Thank you $name! Your message has been sent successfully.";

} catch (Exception $e) {
    $errorMsg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

    }
}
?>

<!-- Your HTML form here -->


<main class="contact-page">

    <!-- Contact Hero -->
    <section class="contact-hero">
        <h1>Contact Us</h1>
        <p>We’re here to help. Get in touch with Trisha Computers.</p>
    </section>

    <!-- Contact Section -->
    <section class="contact-container">

        <!-- Contact Form -->
        <div class="contact-form-box">
            <h2>Send Us a Message</h2>

            <?php if ($successMsg): ?>
                <p class="success-msg"><?= $successMsg; ?></p>
            <?php elseif ($errorMsg): ?>
                <p class="error-msg"><?= $errorMsg; ?></p>
            <?php endif; ?>

            <form method="post" action="">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="phone" placeholder="Phone Number">
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>

        <!-- Google Map Embed -->
        <div class="map-box">
            <iframe 
                src="https://www.google.com/maps?q=Aahna%20Computers,%20Ahmedabad&output=embed"
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>

    </section>

    <!-- Floating Social Media Icons -->
<div class="social-float">
    <a href="https://wa.me/919XXXXXXXXX" target="_blank" class="social whatsapp" title="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="https://www.facebook.com/yourpage" target="_blank" class="social facebook" title="Facebook">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://www.instagram.com/yourpage" target="_blank" class="social instagram" title="Instagram">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="https://www.linkedin.com/in/gaurav-sharma-2b41493ab/" target="_blank" class="social linkedin" title="LinkedIn">
        <i class="fab fa-linkedin-in"></i>
    </a>
</div>

</main>

<?php include 'footer.php'; ?>
