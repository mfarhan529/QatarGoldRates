<?php
session_start();

// ✅ Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../");
    exit();
}

include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // ✅ Show which record is being deleted (optional, for debugging)
    echo "<p>Deleting record with ID: <b>$id</b></p>";

    // ✅ Delete query
    $sql = "DELETE FROM gold_prices WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // ✅ Redirect back with success
        header("Location: view_gold.php?msg=deleted");
        exit();
    } else {
        // ✅ Redirect back with error
        header("Location: view_gold.php?msg=error");
        exit();
    }
} else {
    header("Location: view_gold.php");
    exit();
}
