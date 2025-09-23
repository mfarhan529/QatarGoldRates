<?php
/*
Template Name: Custom Admin Panel
*/
session_start();

$mode = $_GET['mode'] ?? '';

if (isset($_SESSION['admin'])) {
    include get_template_directory() . '/admin/dashboard.php';
} else {
    include get_template_directory() . '/admin/login.php';
}
?>
