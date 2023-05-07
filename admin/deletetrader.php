<?php
include('../db/connection.php');

if (isset($_GET['id']) && isset($_GET['action'])) {
    $delid = $_GET['id'];

    $sqlq = "SELECT * FROM USER_I WHERE USER_ID= :id"; // selecting the all data from the user
    $stmt = oci_parse($conn, $sqlq);
    oci_bind_by_name($stmt, ":id", $delid);
    // exeucuting the query
    oci_execute($stmt);
    while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
        $fname = $row['FIRST_NAME'];
        $lname = $row['LAST_NAME'];
        $email = $row['EMAIL'];
    }

    $username = $fname . " " . $lname;

    $femail = $email;

    $sub = "Notification from chfxmart";
    $message = "Dear " . $username . ",\nSorry!! For this time You are not verified as trader. Try again Later..\nThank You for your interest. ";

    include_once('../sendmail.php');

    $sql = "DELETE FROM USER_I WHERE USER_ID = :did";
    $stid = oci_parse($connection, $sql);
    oci_bind_by_name($stid, ':did', $delid);

    if (oci_execute($stid)) {
        header('location:dashboard.php?name=Users&cat=Traders Lists');
    }
}
?>

<!-- 
<?php
// Replace these variables with your actual database connection details
$db_user = "your_db_user";
$db_pass = "your_db_password";
$db_name = "your_db_name";
$db_host = "your_db_host";

// Connect to the database
$conn = oci_connect($db_user, $db_pass, "{$db_host}/{$db_name}");

// Set the user ID you want to delete
$user_id = 1234;

// Define the SQL query
$sql = "DELETE p, s, c
        FROM products p
        JOIN shops s ON p.shop_id = s.id
        JOIN categories c ON p.category_id = c.id
        WHERE p.user_id = :user_id OR s.user_id = :user_id OR c.user_id = :user_id";

// Prepare the SQL statement
$stmt = oci_parse($conn, $sql);

// Bind the user ID to the SQL statement
oci_bind_by_name($stmt, ":user_id", $user_id);

// Execute the SQL statement
oci_execute($stmt);

// Close the database connection
oci_close($conn);
?> -->