<?php
session_start();



include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $query = "DELETE FROM searches WHERE id=$id";
    $stmt = $conn->prepare($query);
    
    if ($stmt->execute()) {
        header("Location: searches.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
?>
