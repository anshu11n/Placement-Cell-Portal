<?php

// To Handle Session Variables on This Page
session_start();

// If user not logged in, redirect them back to homepage. 
if (empty($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit();
}

// Including Database Connection From db.php file
require_once("../db.php");

// Check if the required GET parameters are present in the URL
if (isset($_GET['id_user']) && isset($_GET['id_jobpost']) && isset($_GET['id_company'])) {
    
    // Retrieve the values from the URL
    $id_user = mysqli_real_escape_string($conn, $_GET['id_user']);
    $id_jobpost = mysqli_real_escape_string($conn, $_GET['id_jobpost']);
    $id_company = mysqli_real_escape_string($conn, $_GET['id_company']);
    
    // Insert the record into the apply_job_post table
    $sql = "INSERT INTO apply_job_post (id_jobpost, id_company, id_user) VALUES ('$id_jobpost', '$id_company', '$id_user')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to a success page or display a success message
        header("Location: index.php");
        exit();
    } else {
        // Handle any errors that occur during the query
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Redirect to homepage if required parameters are missing
    header("Location: ../index.php");
    exit();
}

// Close the database connection
$conn->close();
?>
