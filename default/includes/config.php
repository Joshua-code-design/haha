<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "apply";

// Create connection
$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Failed to connect to MySQL: ' . mysqli_connect_error()
    ]));
}

// Check if patients table exists
$tableCheck = mysqli_query($con, "SHOW TABLES LIKE 'patients'");
if (mysqli_num_rows($tableCheck) == 0) {
    // Load and execute SQL file if table doesn't exist
    $sql = file_get_contents(__DIR__ . '/../sql/create_tables.sql');
    if (!$sql || !mysqli_multi_query($con, $sql)) {
        die(json_encode([
            'status' => 'error',
            'message' => 'Error creating tables: ' . mysqli_error($con)
        ]));
    }
    
    // Clear multi-query results
    while (mysqli_next_result($con)) {
        if (!mysqli_more_results($con)) break;
    }
}
?>