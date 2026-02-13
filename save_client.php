<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /* =========================
       ESCAPE ONLY STRINGS
    ==========================*/

    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name  = mysqli_real_escape_string($conn, $_POST['last_name']);
    $company    = mysqli_real_escape_string($conn, $_POST['company']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $phone      = mysqli_real_escape_string($conn, $_POST['phone']);
    $address1   = mysqli_real_escape_string($conn, $_POST['address1']);
    $address2   = mysqli_real_escape_string($conn, $_POST['address2']);
    $city       = mysqli_real_escape_string($conn, $_POST['city']);
    $state      = mysqli_real_escape_string($conn, $_POST['state']);
    $zip        = mysqli_real_escape_string($conn, $_POST['zip']);
    $website    = mysqli_real_escape_string($conn, $_POST['website']);
    $priority   = mysqli_real_escape_string($conn, $_POST['priority']);
    $info       = mysqli_real_escape_string($conn, $_POST['info']);

    // branch array (NO ESCAPE HERE)
    $branches = $_POST['company_branch'];   // array


    /* =========================
       INSERT CLIENT (NO branch column)
    ==========================*/

    $sql = "INSERT INTO clients 
        (first_name, last_name, company, email, phone, address1, address2, city, state, zip, website, priority, info)
        VALUES
        ('$first_name', '$last_name', '$company', '$email', '$phone', '$address1', '$address2', '$city', '$state', '$zip', '$website', '$priority', '$info')";


    if (mysqli_query($conn, $sql)) {

        $client_id = mysqli_insert_id($conn);


        /* =========================
           INSERT BRANCHES SEPARATELY
        ==========================*/

        if (!empty($branches)) {

            foreach ($branches as $b) {

                if (!empty($b)) {

                    $branch = mysqli_real_escape_string($conn, $b);

                    mysqli_query($conn,
                        "INSERT INTO client_branches (client_id, branch_name)
                         VALUES ('$client_id', '$branch')");
                }
            }
        }

        echo "<script>
                alert('Client Added Successfully');
                window.location.href='admin_dashboard.php';
              </script>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
