<?php
session_start();
require_once "users.php";
require_once "database.php";
$db = new database();
$user = new User($db->conn);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phoneno'];
$address = $_POST['address'];

$error = false;
$_SESSION['name_error'] = $_SESSION['email_error'] = $_SESSION['phone_error'] = $_SESSION['address_error'] = " ";

if (empty($name)) {
    $_SESSION['name_error'] = "Name is required!";
    $error = true;
}
if (empty($email)) {
    $_SESSION['email_error'] = "Email is required!";
    $error = true;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_error'] = "Invalid email format!";
    $error = true;
} elseif ($user->emailExists($email)) {
    $_SESSION['email_error'] = "Email already exists!";
    $error = true;
}
if (empty($phone)) {
    $_SESSION['phone_error'] = "Phone No is required!";
    $error = true;
}
if (empty($address)) {
    $_SESSION['address_error'] = "Adress is required!";
}
if ($error) {
    header("Location: user_frontend.php");
    exit;
}

$user->create($name, $email, $phone, $address);

header("Location: list.php?msg=User+added+successfully");
