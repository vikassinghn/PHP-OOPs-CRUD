<?php
session_start();
require_once 'database.php';
require_once 'users.php';
$db = new database();
$userObj = new User($db->conn);
$id = $_POST['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phoneno'];
$address = $_POST['address'];
$error = false;
$_SESSION['name_error'] = $_SESSION['email_error'] = $_SESSION['phone_error'] = $_SESSION['address_error'] = '';
// Check if email is empty
if (empty($name)) {
    $_SESSION['name_error'] = "Name is required!";
    $error = true;
} elseif (empty($email)) {
    // echo "Email is required!";
    $_SESSION['email_error'] = "Email is required!";
    $error = true;
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_error'] = "Invalid Email!";
    $error = true;
} elseif ($userObj->emailExists($email, $id)) {
    $_SESSION['email_error'] = "Email already exists!";
    $error = true;
}
if (empty($phone)) {
    $_SESSION['phone_error'] = "Phone No is required!";
    $error = true;
}
if (empty($address)) {
    $_SESSION['address_error'] = "Address is required!";
    $error = true;
}
// unset($_SESSION['id']);
if ($error) {
    header("Location: update_frontend.php?id=$id");
    exit;
}
$userObj->update($id, $name, $email, $phone, $address);


header("Location: list.php");
