<?php
// Connect to the database
$conn = oci_connect('username', 'password', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the query
$query = "SELECT * FROM users WHERE username = :username OR email = :email";
$stmt = oci_parse($conn, $query);
if (!$stmt) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Bind parameters
$username = $_POST['username'];
$email = $_POST['email'];
oci_bind_by_name($stmt, ':username', $username);
oci_bind_by_name($stmt, ':email', $email);

// Execute the query
$result = oci_execute($stmt);
if (!$result) {
    $e = oci_error($stmt);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Check if the username or email already exists
if (oci_fetch($stmt)) {
    echo "Username or email already exists";
} else {
    // Prepare the insert statement
    $insert_query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $insert_stmt = oci_parse($conn, $insert_query);
    if (!$insert_stmt) {
        $e = oci_error($conn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    // Bind parameters
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    oci_bind_by_name($insert_stmt, ':username', $username);
    oci_bind_by_name($insert_stmt, ':email', $email);
    oci_bind_by_name($insert_stmt, ':password', $password);

    // Execute the insert statement
    $insert_result = oci_execute($insert_stmt);
    if (!$insert_result) {
        $e = oci_error($insert_stmt);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    echo "User created successfully";
}

// Close the database connection
oci_free_statement($stmt);
oci_free_statement($insert_stmt);
oci_close($conn);
?>
